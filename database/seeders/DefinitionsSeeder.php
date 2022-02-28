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
                resolutions, or gifts the family have received. Whether you choose to incorporate
                this into the service is your choice; however, it is apropos to include a word of
                thanks somewhere on the obituary, which is handed out at the service. It could be as
                simple as: We, the family of [INSERT NAME], would like to express our deep
                appreciation for the many acts of sympathy shown to us during our time of loss.
                Or you could choose to elaborate and make it more personal.
                ",
                'short_text' => 'This is where a family member or someone chosen to speak on behalf
                of the family offers a word of thanks for kindness and support shown to the family
                during their time of grief. The person may also want to acknowledge cards,
                resolutions, or gifts the family have received. Whether you choose to incorporate
                this into the service is your choice; however, it is apropos to include a word of
                thanks somewhere on the obituary, which is handed out at the service.'
            ],
            [
                'term' => 'benediction',
                'full_text' => "The concluding words. Unlike prayers, the benediction is not
                directed towards God, but rather people. This final blessing, which often includes
                dismissal, is pronounced by the officiant after the committal. It generally ends
                with everyone saying 'Amen,' as a way of affirming and acknowledging that the
                parting blessing has been received. Two popular Scriptural benedictions include
                Numbers 6:24-26 and Jude 24-25.",
                'short_text' => NULL
            ],
            [
                'term' => 'call to worship',
                'full_text' => "The opening words of the service usually spoken by the officiating
                minister. This is where the officiant will get listener's attention by stating the
                purpose of the gathering and reminding congregants of the sacredness of the
                occasion. These words are often coupled with a Scripture. For example:
                <blockquote class=\"bg-light p-3\">I lift up my eyes to the hills – from where will
                my help come? My help comes from the LORD,
                who made heaven and earth (Psalm 121:1-2). We greet you all in the majestic name of
                Jesus, our Lord and Savior. We gather today to worship, to proclaim Christ
                crucified and resurrected, and to remember before God our sister/brother,
                [INSERT NAME]. We gather (both in person and virtually) to give thanks for this
                life; to entrust [INSERT NAME] to Christ, the pioneer and perfector of our faith;
                and to comfort one another in our grief, as we are reminded of what is the substance
                of our hope: Death does not have the final word.</blockquote>",
                'short_text' => NULL
            ],
            [
                'term' => 'committal',
                'full_text' => "A brief service performed by the officiating minister whereby the
                body is committed to the ground (in the case of traditional burials) or wherever the
                final resting place may be. The committal most often happens at the cemetery, except
                for extenuating circumstances. The committal is sometimes referred to as a \"burial
                service,\" especially on occasions whereby a funeral service is forgone.",
                'short_text' => NULL
            ],
            [
                'term' => 'cremation',
                'full_text' => "A method of final disposition of a dead body through burning.
                Cremation serves as a funeral or post funeral rite and is a less expensive
                alternative to traditional burials.",
                'short_text' => NULL
            ],
            [
                'term' => 'eulogy',
                'full_text' => "The eulogy is the funeral sermon. It is usually given by the pastor
                or another ordained minister. Etymologically, eulogy means a \"good word.\" The
                eulogy is the part of the service where the pastor speaks a good word on behalf of
                the dead, weaving together their story with the gospel and the story of our faith.
                In situations where the pastor did not know the deceased, I recommend substituting
                \"eulogy\" with \"words of comfort.\"",
                'short_text' => NULL
            ],
            [
                'term' => 'eulogist',
                'full_text' => "The person giving the eulogy. The eulogy is usually given by the
                pastor or another ordained minister.",
                'short_text' => NULL
            ],
            [
                'term' => 'family car(s)',
                'full_text' => "The vehicle(s) used to transport the family to the funeral and/or to
                the cemetery. Most funeral homes have limousines that families can rent for this
                purpose.",
                'short_text' => NULL
            ],
            [
                'term' => 'flower bearers',
                'full_text' => "Persons designated to help carry and stage floral arrangements as
                mourners move from the church to the cemetery. The number of flower bearers is
                contingent on the number and type of arrangements being moved.",
                'short_text' => NULL
            ],
            [
                'term' => 'funeral service',
                'full_text' => "A service intended to remember and honor the life of someone who has
                died. Funerals usually occur with the body present. The Christian funeral is a
                liturgical celebration of the church whereby we express our beliefs, hopes,
                thoughts, and feelings about the deceased. In his book, <i>Accompany Them with
                Singing</i>, Thomas Long notes that Christian funeral practices emerge at the
                intersection of necessity, custom, and conviction. Someone has died (necessity),
                the body must be cared for and carried to the place of burial (custom), where we
                commend our loved ones to God (conviction). The purpose of a funeral is \"to get
                the dead where they need to be and the living where they need to be.\"",
                'short_text' => NULL
            ],
            [
                'term' => 'graveside service',
                'full_text' => "A funeral service that takes place at the graveside.",
                'short_text' => NULL
            ],
            [
                'term' => 'hearse',
                'full_text' => "The vehicle used by the funeral home to transport the casket to the
                funeral and/or to the cemetery.",
                'short_text' => NULL
            ],
            [
                'term' => 'hymn',
                'full_text' => "A selection from the Church's hymnal. Songs like \"Amazing Grace,\"
                \"It is Well with My Soul,\" \"Great is Thy Faithfulness,\" or \"Come, Ye
                Disconsolate\" are all examples of traditional songs sung by the Christian community
                that contain inspiring, well-developed statements of faith and hope.",
                'short_text' => NULL
            ],
            [
                'term' => 'invocation',
                'full_text' => "The opening prayer. A number of prayers will be prayed throughout
                the service, each with a unique purpose. The purpose of the invocation is to
                acknowledge and affirm the Lord's presence (Matthew 18:20), and to ask the Lord's
                blessing upon all the happenings of the day. Though much planning and thought has
                gone into the service, still we yield to the superintending movement of the Holy
                Spirit.",
                'short_text' => NULL
            ],
            [
                'term' => 'memorial service',
                'full_text' => "A service intended to remember and honor life of someone who has
                died. A memorial service is akin to a funeral but does not include the body of the
                deceased (i.e. no casket or urn). Because a memorial does not include or necessitate
                the remains of the deceased being present, a memorial service can take place months
                after someone has passed away. Like a funeral, the memorial is intended to honor the
                life of a loved one. Music, scripture readings, and reflections are all apropos. The
                service may or may not include a eulogy; a brief word of comfort from a minister
                will suffice.",
                'short_text' => NULL
            ],
            [
                'term' => 'mortician\'s brief',
                'full_text' => "At the end of the funeral, the mortician(s) will come forward to
                offer remarks, give instructions for exiting the building, and for the procession
                to the cemetery. Depending on the funeral home, they will also use this moment to
                present a keepsake or memento on behalf of the funeral home.",
                'short_text' => NULL
            ],
            [
                'term' => 'new testament scripture reading',
                'full_text' => "A reading taken from one of the 27 books that comprise what
                Christians call the New Testament. Central to any worship service is the reading of
                Scripture. In the Scripture, we not only find words about God and words directed to
                God, but we also find words from God addressed to us. Scriptures are both
                informational in nature and formational in purpose. Hearing the word of God shapes
                us, gives meaning to the service, brings perspective to pain, and reminds us that
                though tragedy has a way of hiding the face of God, God is present and continues to
                speak.",
                'short_text' => NULL
            ],
            [
                'term' => 'obituary',
                'full_text' => "Obituary generally refers to the official announcement of someone's
                death that is published in the newspaper, on the funeral home website, and other
                platforms such as email or social media. In the context of funerals or memorial
                services, it refers to the biographical information and list of familial survivors
                detailed in the program. This obituary is usually more elaborate than the general
                announcement made in the newspaper or elsewhere. Sometimes people will refer to the
                entire program as an \"obituary.\"",
                'short_text' => NULL
            ],
            [
                'term' => 'officiant',
                'full_text' => "The clergy person who presides over the service. In most cases, the
                service is carried out by the pastor or some other official delegate of the church.",
                'short_text' => NULL
            ],
            [
                'term' => 'old testament scripture reading',
                'full_text' => "A reading taken from one of the 39 books that comprise what
                Christians call the Old Testament. Central to any worship service is the reading of
                Scripture. In the Scripture, we not only find words about God and words directed to
                God, but we also find words from God addressed to us. Scriptures are both
                informational in nature and formational in purpose. Hearing the word of God shapes
                us, gives meaning to the service, brings perspective to pain, and reminds us that
                though tragedy has a way of hiding the face of God, God is present and continues to
                speak.",
                'short_text' => NULL
            ],
            [
                'term' => 'pallbearers',
                'full_text' => "Persons designated to help escort or carry the casket as mourners
                move from the church to the cemetery. Loading the body in and out of the hearse
                usually requires at least 6 people.",
                'short_text' => NULL
            ],
            [
                'term' => 'prelude',
                'full_text' => "Instrumental music at the beginning of the service. It's often
                played as people get seated and situated just before the \"call to worship.\"",
                'short_text' => NULL
            ],
            [
                'term' => 'procession',
                'full_text' => "The group of people or vehicles traveling from the funeral to the
                cemetery. The procession is generally led by someone from the police or sheriff's
                department, with the officiant and morticians in the front, followed by the hearse
                and the family car(s). Drivers are asked to keep their flashers on as a way of
                signaling to others that they are part of the procession.",
                'short_text' => NULL
            ],
            [
                'term' => 'postlude',
                'full_text' => "Instrumental music at the end of the service that is often played
                after the dismissal as persons make their exit.",
                'short_text' => NULL
            ],
            [
                'term' => 'prayer of comfort',
                'full_text' => "A prayer that is prayed mid-service, usually following the Scripture
                readings. As the name suggests, the purpose of this prayer is to intercede on
                behalf of the family, friends, and all those left to mourn the passing of the
                deceased. As part of his Sermon on The Mount, Jesus said, \"Blessed are those who
                mourn, for they will be comforted\" (Matthew 5:4).",
                'short_text' => NULL
            ],
            [
                'term' => 'processional',
                'full_text' => "The formal entrance. This is when the officiating minister leads the
                family into the sanctuary or chapel.",
                'short_text' => NULL
            ],
            [
                'term' => 'recessional',
                'full_text' => "The formal exit. There is generally an order to exiting the
                sanctuary or chapel. In most cases, it is directed by the funeral home. It is
                usually clergy followed by the floral bearers, paul bearers (with the casket), then
                the family.",
                'short_text' => NULL
            ],
            [
                'term' => 'repast',
                'full_text' => "A meal served after the service. It is commonplace in the Black
                church tradition to have families and friends of the deceased return to the church
                for a meal prepared by the church; however, with Covid and other changing
                circumstances, this custom is being rethought.",
                'short_text' => NULL
            ],
            [
                'term' => 'viewing',
                'full_text' => "The time set aside for mourners to offer their condolences to the
                family and pay their last respects. This is sometimes referred to as the visitation
                and is often an hour or so prior to the service.",
                'short_text' => NULL
            ],
            [
                'term' => 'wake',
                'full_text' => "Similar to the viewing, a wake is the time set aside for mourners to
                offer their condolences to the family and pay their last respects. Wakes are usually
                held a day or so before the actual funeral and will sometimes include a program
                (prayer, scripture reading, remarks, and benediction.",
                'short_text' => NULL
            ],
            [
                'term' => 'words of comfort',
                'full_text' => "A sermonette given at the funeral or memorial service. The eulogy is
                the part of the service where the pastor speaks a good word on behalf of the dead;
                however, in some cases, the pastor did not know the deceased personally.
                Consequently, \"words of comfort\" are substituted for the eulogy. Because the pastor
                has no firsthand knowledge of the deceased, the pastor will focus more on those left
                to mourn the passing of the deceased, reminding them that \"The Lord is near to the
                brokenhearted, and saves the crushed in spirit\" (Ps. 34:18).",
                'short_text' => NULL
            ],
        ]);
    }
}
