<?php namespace Sarunas\Gameq\Protocols;

use Sarunas\Gameq\Protocols;
use Sarunas\Gameq\Buffer;
/**
 * This file is part of Gameq.
 *
 * Gameq is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * Gameq is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *
 */


class Minecraft extends Protocols {

	protected $packets = array(
		//'status' => "\xFE",
		'status' => "\xFE\x01",
	);

	protected $query_port = 25565;
	protected $ports_type = self::PT_SAME;
	
	protected $protocol = 'minecraft';
	protected $name = 'minecraft';
	protected $name_long = "Minecraft";
	
	
	public function init() {
		$this->queue('status', 'tcp', $this->packets['status'], array('response_count' => 1));
	}
	
	protected function processRequests($qid, $requests) {
		if ($qid === 'status') {
			return $this->_process_status($requests['responses']);
		}
	}
	
	protected function _process_status($packets) {
		// http://www.wiki.vg/Server_List_Ping
		// https://gist.github.com/barneygale/1209061
		
		$buf = new Buffer($packets[0]);
		
		if ($buf->read(1) !== "\xFF") {
			$this->debug("Wrong header");
			return false;
		}
		
		
		// packet length
		$buf->skip(2);
		
		$cbuf = iconv("UTF-16BE//IGNORE", "UTF-8", $buf->getBuffer());
		
		// New version
		if (substr($cbuf, 0, 2) === "\xC2\xA7") {
			$info = explode("\x00", substr($cbuf, 2));
			
			// $info[0] = 1
			$this->result->addSetting('protocol_version', $info[1]);
			
			$this->result->addGeneral('version', $info[2]);
			$this->result->addGeneral('hostname', $info[3]);
			
			$this->result->addGeneral('num_players', min(intval($info[4]), intval($info[5])));
			$this->result->addGeneral('max_players', intval($info[5]));
		
		} else {
			$info = explode("\xC2\xA7", $cbuf);
			
			// Actually it is MotD, but they usually use this as server name
			$this->result->addGeneral('hostname', $info[0]);
			$this->result->addGeneral('num_players', min(intval($info[1]), intval($info[2])));
			$this->result->addGeneral('max_players', intval($info[2]));
		}
	}
	
}