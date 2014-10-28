<?php
/**
 * This file is part of GameQ.
 *
 * GameQ is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * GameQ is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


namespace Sarunas\Gameq\Protocols;
 
class Ut extends \Gameq\Protocols\Gamespy {
	protected $name = "ut";
	protected $name_long = "Unreal Tournament";

	protected $query_port = 7778;
	protected $connect_port = 7777;
	protected $ports_type = self::PT_DIFFERENT_COMPUTABLE;
}
