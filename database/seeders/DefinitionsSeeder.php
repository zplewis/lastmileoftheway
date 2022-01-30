<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefinitionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('definitions')->insert([
            [
                'term' => 'acknowledgements',
                'full_text' => "This is where a family member or someone chosen to speak on behalf
                of the family offers a word of thanks for kindness and support shown to the family
                during their time of grief. The person may also want to acknowledge cards,
                resolutions, or gifts they have received. Examples include obituaries,
                acknowledgments may be written on the program."
            ],
            [
                'term' => 'benediction',
                'full_text' => "The concluding words. Unlike prayers, the benediction is not
                directed towards God, but rather people. This final blessing, which often includes
                dismissal, is pronounced by the officiant after the committal. It generally ends
                with everyone saying 'Amen,' as a way of affirming and acknowledging that the
                parting blessing has been received. Two popular Scriptural benedictions include
                Numbers 6:24-26 and Jude 24-25."
            ]
        ]);
    }
}
