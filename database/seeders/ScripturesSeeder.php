<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Models\BibleVersions;
use \App\Models\BibleBook;
use Illuminate\Support\Facades\Log;

class ScripturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nrsv = BibleVersions::where('acronymn', 'NRSV')->first()->id;

        $scriptures = [
            $nrsv => [
                [
                    'bible_book_id' => BibleBook::where('name', 'Job')->first()->id,
                    'title' => 'My Redeemer Lives',
                    'location' => 'Job 19:23-27',
                    'verses' => "Oh that my words were now written! Oh that they were printed in a
                    book! That they were graven with an iron pen and lead In the rock for ever! For
                    I know that my redeemer liveth, And that he shall stand at the latter day upon
                    the earth: And though after my skin worms destroy this body, Yet in my flesh
                    shall I see God: Whom I shall see for myself, And mine eyes shall behold, and
                    not another; Though my reins be consumed within me."
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Psalm')->first()->id,
                    'title' => 'The Shepherd\'s Psalm',
                    'location' => 'Psalm 23',
                    'verses' => "The Lord is my shepherd, I shall not want. He makes me lie down in
                    green pastures; he leads me beside still waters; he restores my soul. He leads
                    me in right paths for his name's sake. Even though I walk through the darkest
                    valley, I fear no evil; for you are with me; your rod and your staff—they
                    comfort me. You prepare a table before me in the presence of my enemies; you
                    anoint my head with oil; my cup overflows. Surely goodness and mercy shall
                    follow me all the days of my life, and I shall dwell in the house of the Lord
                    my whole life long."
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Psalm')->first()->id,
                    'title' => 'The Lord is Our Light and Salvation',
                    'location' => 'Psalm 27:1-4, 13-14',
                    'verses' => "The Lord is my light and my salvation;
                    whom shall I fear?
                The Lord is the stronghold of my life;
                    of whom shall I be afraid?
                When evildoers assail me
                    to devour my flesh—
                my adversaries and foes—
                    they shall stumble and fall.

                Though an army encamp against me,
                    my heart shall not fear;
                though war rise up against me,
                    yet I will be confident.

                One thing I asked of the Lord,
                    that will I seek after:
                to live in the house of the Lord
                    all the days of my life,
                to behold the beauty of the Lord,
                    and to inquire in his temple.

                I believe that I shall see the goodness of the Lord
                    in the land of the living. Wait for the Lord;
                    be strong, and let your heart take courage;
                    wait for the Lord!"
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Psalm')->first()->id,
                    'title' => 'Thirsting For God',
                    'location' => 'Psalm 42:1-5',
                    'verses' => "As a deer longs for flowing streams,
                    so my soul longs for you, O God.
                My soul thirsts for God,
                    for the living God.
                When shall I come and behold
                    the face of God?
                My tears have been my food
                    day and night,
                while people say to me continually,
                    “Where is your God?”

                These things I remember,
                    as I pour out my soul:
                how I went with the throng,[a]
                    and led them in procession to the house of God,
                with glad shouts and songs of thanksgiving,
                    a multitude keeping festival.
                Why are you cast down, O my soul,
                    and why are you disquieted within me?
                Hope in God; for I shall again praise him,
                    my help and my God."
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Psalm')->first()->id,
                    'title' => 'The Lord is Refuge and Strength',
                    'location' => 'Psalm 46:1-2, 10-11',
                    'verses' => "God is our refuge and strength,
                    a very present help in trouble.
                Therefore we will not fear, though the earth should change,
                    though the mountains shake in the heart of the sea;

                \"Be still, and know that I am God!
                    I am exalted among the nations,
                    I am exalted in the earth.\"
                The Lord of hosts is with us;
                    the God of Jacob is our refuge. Selah"
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Psalm')->first()->id,
                    'title' => 'Lead Me to The Rock',
                    'location' => 'Psalm 61',
                    'verses' => "Hear my cry, O God;
                    listen to my prayer.
                From the end of the earth I call to you,
                    when my heart is faint.

                Lead me to the rock
                    that is higher than I;
                for you are my refuge,
                    a strong tower against the enemy.

                Let me abide in your tent forever,
                    find refuge under the shelter of your wings. Selah
                For you, O God, have heard my vows;
                    you have given me the heritage of those who fear your name.

                Prolong the life of the king;
                    may his years endure to all generations!
                May he be enthroned forever before God;
                    appoint steadfast love and faithfulness to watch over him!

                So I will always sing praises to your name,
                    as I pay my vows day after day."
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Psalm')->first()->id,
                    'title' => 'Number Our Days',
                    'location' => 'Psalm 90:1-6, 12',
                    'verses' => "Lord, you have been our dwelling place
                    in all generations.
                Before the mountains were brought forth,
                    or ever you had formed the earth and the world,
                    from everlasting to everlasting you are God.

                You turn us back to dust,
                    and say, \"Turn back, you mortals.\"
                For a thousand years in your sight
                    are like yesterday when it is past,
                    or like a watch in the night.

                You sweep them away; they are like a dream,
                    like grass that is renewed in the morning;
                in the morning it flourishes and is renewed;
                    in the evening it fades and withers.

                So teach us to count our days
                    that we may gain a wise heart."
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Psalm')->first()->id,
                    'title' => 'The Lord is Our Keeper',
                    'location' => 'Psalm 121',
                    'verses' => "I lift up my eyes to the hills—
                    from where will my help come?
                My help comes from the Lord,
                    who made heaven and earth.

                He will not let your foot be moved;
                    he who keeps you will not slumber.
                He who keeps Israel
                    will neither slumber nor sleep.

                The Lord is your keeper;
                    the Lord is your shade at your right hand.
                The sun shall not strike you by day,
                    nor the moon by night.

                The Lord will keep you from all evil;
                    he will keep your life.
                The Lord will keep
                    your going out and your coming in
                    from this time on and forevermore."
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Psalm')->first()->id,
                    'title' => 'Lead Me in The Way',
                    'location' => 'Psalm 139:7-12, 23-24',
                    'verses' => "Where can I go from your spirit?
                    Or where can I flee from your presence?
                If I ascend to heaven, you are there;
                    if I make my bed in Sheol, you are there.
                If I take the wings of the morning
                    and settle at the farthest limits of the sea,
                even there your hand shall lead me,
                    and your right hand shall hold me fast.
                If I say, \"Surely the darkness shall cover me,
                    and the light around me become night,\"
                even the darkness is not dark to you;
                    the night is as bright as the day,
                    for darkness is as light to you.

                Search me, O God, and know my heart;
                    test me and know my thoughts.
                See if there is any wicked way in me,
                    and lead me in the way everlasting."
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Ecclesiastes')->first()->id,
                    'title' => 'A Time for Everything',
                    'location' => 'Ecclesiastes 3:1-4',
                    'verses' => "For everything there is a season, and a time for every matter under heaven:
                        a time to be born, and a time to die;
                        a time to plant, and a time to pluck up what is planted;
                        a time to kill, and a time to heal;
                        a time to break down, and a time to build up;
                        a time to weep, and a time to laugh;
                        a time to mourn, and a time to dance;"
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Lamentations')->first()->id,
                    'title' => 'Great is Thy Faithfulness',
                    'location' => 'Lamentations 3:22-26, 31-33',
                    'verses' => "The steadfast love of the Lord never ceases,
                    his mercies never come to an end;
                they are new every morning;
                    great is your faithfulness.
                \"The Lord is my portion,\" says my soul,
                    \"therefore I will hope in him.\"

                The Lord is good to those who wait for him,
                    to the soul that seeks him.
                It is good that one should wait quietly
                    for the salvation of the Lord.

                For the Lord will not
                    reject forever.
                Although he causes grief, he will have compassion
                    according to the abundance of his steadfast love;
                for he does not willingly afflict
                    or grieve anyone."
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Matthew')->first()->id,
                    'title' => 'Rest For Our Soul',
                    'location' => 'Matthew 11:28-30',
                    'verses' => "\"Come to me, all you that are weary and are carrying heavy
                    burdens, and I will give you rest. Take my yoke upon you, and learn from me;
                    for I am gentle and humble in heart, and you will find rest for your souls.
                    For my yoke is easy, and my burden is light.\""
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'John')->first()->id,
                    'title' => 'The Good Shepherd Gives Eternal Life',
                    'location' => 'John 10:27-29',
                    'verses' => null
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'John')->first()->id,
                    'title' => 'Jesus, the Resurrection',
                    'location' => 'John 11:17-26',
                    'verses' => null
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'John')->first()->id,
                    'title' => 'Jesus, the Way, Truth, and Life',
                    'location' => 'John 14:1-6',
                    'verses' => null
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Romans')->first()->id,
                    'title' => 'God\'s Love',
                    'location' => 'Romans 8:31-39',
                    'verses' => null
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Romans')->first()->id,
                    'title' => 'We Are the Lord\'s',
                    'location' => 'Romans 14:7-9',
                    'verses' => null
                ],
                [
                    'bible_book_id' => BibleBook::where('name', '1 Corinthians')->first()->id,
                    'title' => 'Love',
                    'location' => '1 Corinthians 13:1-13',
                    'verses' => null
                ],
                [
                    'bible_book_id' => BibleBook::where('name', '1 Corinthians')->first()->id,
                    'title' => 'We Will All Be Changed',
                    'location' => '1 Corinthians 15:51-56',
                    'verses' => null
                ],
                [
                    'bible_book_id' => BibleBook::where('name', '2 Corinthians')->first()->id,
                    'title' => 'God of All Consolation',
                    'location' => '2 Corinthians 1:3-7',
                    'verses' => null
                ],
                [
                    'bible_book_id' => BibleBook::where('name', '2 Corinthians')->first()->id,
                    'title' => 'We Do Not Lose Heart',
                    'location' => '2 Corinthians 4:16-18',
                    'verses' => null
                ],
                [
                    'bible_book_id' => BibleBook::where('name', '2 Corinthians')->first()->id,
                    'title' => 'Our Building from God',
                    'location' => '2 Corinthians 5:1-5',
                    'verses' => null
                ],
                [
                    'bible_book_id' => BibleBook::where('name', '1 Thessalonians')->first()->id,
                    'title' => 'Words of Comfort',
                    'location' => '1 Thessalonians 4:13-18',
                    'verses' => null
                ],
                [
                    'bible_book_id' => BibleBook::where('name', '2 Timothy')->first()->id,
                    'title' => 'A Fought Fight, Finished Course, and Kept Faith',
                    'location' => '2 Timothy 4:6-8',
                    'verses' => null
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Revelation')->first()->id,
                    'title' => 'God Will Wipe Tears Away',
                    'location' => 'Revelation 7:15-17',
                    'verses' => null
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Revelation')->first()->id,
                    'title' => 'A New Heaven and earth',
                    'location' => 'Revelation 21:1-6',
                    'verses' => null
                ],
            ]
        ];

        $data = [];

        foreach ($scriptures as $version => $passages) {
            foreach ($passages as $passage) {
                $passage['bible_versions_id'] = $nrsv;
                Log::debug('passage: ', $passage);
                $data[] = $passage;
            }
        }

        DB::table('scriptures')->insert($data);
    }
}
