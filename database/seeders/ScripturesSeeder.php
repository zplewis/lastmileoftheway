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
                    \"Where is your God?\"

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
                    'verses' => "My sheep hear my voice. I know them, and they follow me. I give them
                    eternal life, and they will never perish. No one will snatch them out of my hand.
                    What my Father has given me is greater than all else, and no one can snatch it
                    out of the Father's hand."
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'John')->first()->id,
                    'title' => 'Jesus, the Resurrection',
                    'location' => 'John 11:17-26',
                    'verses' => 'When Jesus arrived, he found that Lazarus had already been in the
                    tomb four days. Now Bethany was near Jerusalem, some two miles away, and many
                    of the Jews had come to Martha and Mary to console them about their brother.
                    When Martha heard that Jesus was coming, she went and met him, while Mary stayed
                    at home. Martha said to Jesus, "Lord, if you had been here, my brother would
                    not have died. But even now I know that God will give you whatever you ask of
                    him. Jesus said to her, "Your brother will rise again." Martha said to him,
                    "I know that he will rise again in the resurrection on the last day." Jesus
                    said to her, "I am the resurrection and the life. Those who believe in me,
                    even though they die, will live, and everyone who lives and believes in me will
                    never die. Do you believe this?"'
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'John')->first()->id,
                    'title' => 'Jesus, the Way, Truth, and Life',
                    'location' => 'John 14:1-6',
                    'verses' => '"Do not let your hearts be troubled. Believe in God, believe also
                    in me. In my Father\'s house there are many dwelling places. If it were not so,
                    would I have told you that I go to prepare a place for you? And if I go and
                    prepare a place for you, I will come again and will take you to myself, so
                    that where I am, there you may be also. And you know the way to the place where
                    I am going." Thomas said to him, "Lord, we do not know where you are going.
                    How can we know the way?" Jesus said to him, "I am the way, and the truth, and
                    the life. No one comes to the Father except through me.'
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Romans')->first()->id,
                    'title' => 'God\'s Love in Christ Jesus',
                    'location' => 'Romans 8:31-39',
                    'verses' => 'What then are we to say about these things? If God is for us, who
                    is against us? He who did not withhold his own Son, but gave him up for all of
                    us, will he not with him also give us everything else? Who will bring any charge
                    against God\'s elect? It is God who justifies. Who is to condemn? It is Christ
                    Jesus, who died, yes, who was raised, who is at the right hand of God, who indeed
                    intercedes for us. Who will separate us from the love of Christ? Will hardship,
                    or distress, or persecution, or famine, or nakedness, or peril, or sword?
                    As it is written,
                    "For your sake we are being killed all day long;
                        we are accounted as sheep to be slaughtered."

                    No, in all these things we are more than conquerors through him who loved us.
                    For I am convinced that neither death, nor life, nor angels, nor rulers, nor
                    things present, nor things to come, nor powers, nor height, nor depth, nor
                    anything else in all creation, will be able to separate us from the love of
                    God in Christ Jesus our Lord.'
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Romans')->first()->id,
                    'title' => 'We Are the Lord\'s',
                    'location' => 'Romans 14:7-9',
                    'verses' => 'We do not live to ourselves, and we do not die to ourselves.
                    If we live, we live to the Lord, and if we die, we die to the Lord; so then,
                    whether we live or whether we die, we are the Lord\'s. For to this end Christ
                    died and lived again, so that he might be Lord of both the dead and the living.'
                ],
                [
                    'bible_book_id' => BibleBook::where('name', '1 Corinthians')->first()->id,
                    'title' => 'The Gift of Love',
                    'location' => '1 Corinthians 13:1-13',
                    'verses' => 'If I speak in the tongues of mortals and of angels, but do not have
                    love, I am a noisy gong or a clanging cymbal. And if I have prophetic powers,
                    and understand all mysteries and all knowledge, and if I have all faith, so as
                    to remove mountains, but do not have love, I am nothing. If I give away all my
                    possessions, and if I hand over my body so that I may boast, but do not have
                    love, I gain nothing.

                    Love is patient; love is kind; love is not envious or boastful or arrogant or
                    rude. It does not insist on its own way; it is not irritable or resentful; it
                    does not rejoice in wrongdoing, but rejoices in the truth. It bears all things,
                    believes all things, hopes all things, endures all things.

                    Love never ends. But as for prophecies, they will come to an end; as for
                    tongues, they will cease; as for knowledge, it will come to an end. For we know
                    only in part, and we prophesy only in part; but when the complete comes, the
                    partial will come to an end. When I was a child, I spoke like a child, I
                    thought like a child, I reasoned like a child; when I became an adult, I put an
                    end to childish ways. For now we see in a mirror, dimly, but then we will see
                    face to face. Now I know only in part; then I will know fully, even as I have
                    been fully known. And now faith, hope, and love abide, these three; and the
                    greatest of these is love.'
                ],
                [
                    'bible_book_id' => BibleBook::where('name', '1 Corinthians')->first()->id,
                    'title' => 'We Will All Be Changed',
                    'location' => '1 Corinthians 15:51-56',
                    'verses' => 'Listen, I will tell you a mystery! We will not all die, but we will
                    all be changed, in a moment, in the twinkling of an eye, at the last trumpet.
                    For the trumpet will sound, and the dead will be raised imperishable, and we
                    will be changed. For this perishable body must put on imperishability, and this
                    mortal body must put on immortality. When this perishable body puts on
                    imperishability, and this mortal body puts on immortality, then the saying that
                    is written will be fulfilled:

                    "Death has been swallowed up in victory."
                    "Where, O death, is your victory?
                        Where, O death, is your sting?"

                    The sting of death is sin, and the power of sin is the law.'
                ],
                [
                    'bible_book_id' => BibleBook::where('name', '2 Corinthians')->first()->id,
                    'title' => 'God of All Consolation',
                    'location' => '2 Corinthians 1:3-7',
                    'verses' => 'Blessed be the God and Father of our Lord Jesus Christ, the Father
                    of mercies and the God of all consolation, who consoles us in all our
                    affliction, so that we may be able to console those who are in any affliction
                    with the consolation with which we ourselves are consoled by God. For just as
                    the sufferings of Christ are abundant for us, so also our consolation is
                    abundant through Christ. If we are being afflicted, it is for your consolation
                    and salvation; if we are being consoled, it is for your consolation, which you
                    experience when you patiently endure the same sufferings that we are also
                    suffering. Our hope for you is unshaken; for we know that as you share in our
                    sufferings, so also you share in our consolation.'
                ],
                [
                    'bible_book_id' => BibleBook::where('name', '2 Corinthians')->first()->id,
                    'title' => 'We Do Not Lose Heart',
                    'location' => '2 Corinthians 4:16-18',
                    'verses' => 'So we do not lose heart. Even though our outer nature is wasting
                    away, our inner nature is being renewed day by day. For this slight momentary
                    affliction is preparing us for an eternal weight of glory beyond all measure,
                    because we look not at what can be seen but at what cannot be seen; for what
                    can be seen is temporary, but what cannot be seen is eternal.'
                ],
                [
                    'bible_book_id' => BibleBook::where('name', '2 Corinthians')->first()->id,
                    'title' => 'Our Building from God',
                    'location' => '2 Corinthians 5:1-5',
                    'verses' => 'For we know that if the earthly tent we live in is destroyed, we
                    have a building from God, a house not made with hands, eternal in the heavens.
                    For in this tent we groan, longing to be clothed with our heavenly dwelling—if
                    indeed, when we have taken it off we will not be found naked. For while we are
                    still in this tent, we groan under our burden, because we wish not to be
                    unclothed but to be further clothed, so that what is mortal may be swallowed up
                    by life. He who has prepared us for this very thing is God, who has given us
                    the Spirit as a guarantee.'
                ],
                [
                    'bible_book_id' => BibleBook::where('name', '1 Thessalonians')->first()->id,
                    'title' => 'Words of Comfort',
                    'location' => '1 Thessalonians 4:13-18',
                    'verses' => 'But we do not want you to be uninformed, brothers and sisters,
                    about those who have died, so that you may not grieve as others do who have no
                    hope. For since we believe that Jesus died and rose again, even so, through
                    Jesus, God will bring with him those who have died. For this we declare to you
                    by the word of the Lord, that we who are alive, who are left until the coming
                    of the Lord, will by no means precede those who have died. For the Lord himself,
                    with a cry of command, with the archangel\'s call and with the sound of God\'s
                    trumpet, will descend from heaven, and the dead in Christ will rise first. Then
                    we who are alive, who are left, will be caught up in the clouds together with
                    them to meet the Lord in the air; and so we will be with the Lord forever.
                    Therefore encourage one another with these words.'
                ],
                [
                    'bible_book_id' => BibleBook::where('name', '2 Timothy')->first()->id,
                    'title' => 'A Fought Fight, Finished Course, and Kept Faith',
                    'location' => '2 Timothy 4:6-8',
                    'verses' => 'As for me, I am already being poured out as a libation, and the
                    time of my departure has come. I have fought the good fight, I have finished
                    the race, I have kept the faith. From now on there is reserved for me the crown
                    of righteousness, which the Lord, the righteous judge, will give me on that day,
                    and not only to me but also to all who have longed for his appearing.'
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Revelation')->first()->id,
                    'title' => 'God Will Wipe Tears Away',
                    'location' => 'Revelation 7:15-17',
                    'verses' => 'For this reason they are before the throne of God,
                    and worship him day and night within his temple,
                    and the one who is seated on the throne will shelter them.
                    They will hunger no more, and thirst no more;
                    the sun will not strike them,
                    nor any scorching heat;
                    for the Lamb at the center of the throne will be their shepherd,
                    and he will guide them to springs of the water of life,
                    and God will wipe away every tear from their eyes."'
                ],
                [
                    'bible_book_id' => BibleBook::where('name', 'Revelation')->first()->id,
                    'title' => 'The New Heaven and the New Earth',
                    'location' => 'Revelation 21:1-6',
                    'verses' => 'Then I saw a new heaven and a new earth; for the first heaven and
                    the first earth had passed away, and the sea was no more. And I saw the holy
                    city, the new Jerusalem, coming down out of heaven from God, prepared as a
                    bride adorned for her husband. And I heard a loud voice from the throne saying,

                    "See, the home of God is among mortals.
                    He will dwell with them;
                    they will be his peoples,
                    and God himself will be with them;
                    he will wipe every tear from their eyes.
                    Death will be no more;
                    mourning and crying and pain will be no more,
                    for the first things have passed away."

                    And the one who was seated on the throne said, "See, I am making all things
                    new." Also he said, "Write this, for these words are trustworthy and true."
                    Then he said to me, "It is done! I am the Alpha and the Omega, the beginning
                    and the end. To the thirsty I will give water as a gift from the spring of the
                    water of life.'
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
