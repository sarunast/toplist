<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
        $this->call('categories');
        $this->call('subcategories');
	}

}
class categories extends Seeder
{

    public function run()
    {

        DB::table('categories')->delete();
        DB::table('categories')->insert(array(

                array(
                    'name' => 'MMO'
                ),
                array(
                    'name' => 'FPS'
                )
            )
        );
    }

}
class subcategories extends Seeder
{

    public function run()
    {

        DB::table('subcategories')->delete();
        DB::table('subcategories')->insert(array(

                array(
                    'category_id' => 1,
                    'name' => 'Lineage2',
                    'path' => 'lineage2',
                    'alias' => null

                ),
                array(
                    'category_id' => 1,
                    'name' => 'Aion',
                    'path' => 'aion',
                    'alias' => null
                ),
                array(
                    'category_id' => 1,
                    'name' => 'World of Warcraft',
                    'path' => 'world-of-warcraft',
                    'alias' => null
                ),
                array(
                    'category_id' => 1,
                    'name' => 'MU Online',
                    'path' => 'mu-online',
                    'alias' => null
                ),
                array(
                    'category_id' => 1,
                    'name' => 'Ultima Online',
                    'path' => 'ultima-online',
                    'alias' => null
                ),
                array(
                    'category_id' => 1,
                    'name' => 'SilkRoad Online',
                    'path' => 'silkroad-online',
                    'alias' => null
                ),
                array(
                    'category_id' => 1,
                    'name' => 'Ragnarok Online',
                    'path' => 'ragnarok-online',
                    'alias' => null
                ),
                array(
                    'category_id' => 1,
                    'name' => 'MineCraft',
                    'path' => 'minecraft',
                    'alias' => 'minecraft'
                ),
                array(
                    'category_id' => 2,
                    'name' => 'DayZ',
                    'path' => 'dayz',
                    'alias' => 'dayz'
                ),
                array(
                    'category_id' => 2,
                    'name' => 'Counter Strike 1.6',
                    'path' => 'counter-strike',
                    'alias' => 'cs'
                ),
                array(
                    'category_id' => 2,
                    'name' => 'Counter Strike Source',
                    'path' => 'counter-strike-source',
                    'alias' => 'css'
                ),
                array(
                    'category_id' => 2,
                    'name' => 'Counter Strike GO',
                    'path' => 'counter-strike-go',
                    'alias' => 'csgo'
                ),
                array(
                    'category_id' => 2,
                    'name' => 'Half-life 2',
                    'path' => 'half-life-2',
                    'alias' => 'hl2dm'
                ),
                array(
                    'category_id' => 2,
                    'name' => 'Team Fortress 2',
                    'path' => 'team-fortress-2',
                    'alias' => 'tf2'
                ),
                array(
                    'category_id' => 2,
                    'name' => 'San Andreas MP',
                    'path' => 'san-andreas-mp',
                    'alias' => 'samp'
                ),
                array(
                    'category_id' => 2,
                    'name' => 'Call of Duty 4',
                    'path' => 'call-of-duty-4',
                    'alias' => 'cod4'
                ),
                array(
                    'category_id' => 2,
                    'name' => 'Left 4 Dead',
                    'path' => 'left-4-dead',
                    'alias' => 'left4dead'
                )
            )
        );
    }

}