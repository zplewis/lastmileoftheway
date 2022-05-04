@extends('layout')

@section('content')
<div class="px-4 py-5 my-5 text-center" id="about-this-site">
    <h1 class="display-5 fw-bold">About this site</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead"><i>Last Mile of the Way</i> is an interactive website designed to help
          those thrust into the uncomfortable position of having to plan a funeral or
          memorial service.
      <p class="lead">This site can also be used
          as a church counterpart to a pre-need contract, a service offered by most funeral homes
          which allows people to decide on which services they want in advance. This website allows
          you to make your requests known. Use this site to make your requests known. Determine a
          program outline based on the type of service you envision, save or print a copy of your
          order of service, and place it with
          other important documents intended for those who will be tasked with making your final
          arrangements.</p>
    </div>
</div>

<div class="container col-xxl-8 px-4 py-5" id="about-pastor-farrow">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="{{ url('images/about-pastor-farrow-2.png') }}" class="d-block mx-lg-auto img-fluid" alt="Pastor Farrow picture" width="700" height="500" loading="lazy">
      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3">About Pastor Farrow</h1>
        <p class="lead">
            The Reverend Thomas Farrow, Jr. is the pastor of  <a href="https://reederministries.org/" title="Reeder Memorial Baptist Church">Reeder
            Memorial Baptist Church of Charlotte, NC</a>, where he has served for the past 5 years. Prior to coming to Charlotte, Rev. Farrow served at First Baptist Church Clinton for six years. Rev. Farrow holds a Bachelor of Science degree in Business Administration and a Master of Arts degree in Mental Health Counseling from North Carolina Central University. He holds a Master of Divinity Degree from Campbell University, where he is currently studying to obtain his Doctorate of Ministry Degree.
        </p>
        <p class="lead">
        Rev Farrow serves God faithfully as evidenced by his unique and energetic preaching and teaching style. He approaches the tasks of ministry with earnestness, sincerity and humility. Rev. Farrow has preached all over North Carolina and beyond in diverse contexts. He’s preached in the prison, nursing homes, and in various denominational traditions. He has preached the MLK Commemorative Day Service for Shaw University. He has preached multiple times for the students at Campbell University. He has also preached and taught at the General Baptist State Convention of NC’s Annual Session. He is active in the United Missionary Baptist Association as well as the State Convention, where he serves on the Executive Board.</p>
        <p class="lead">
        Among his numerous honors and awards, Rev. Farrow has been recognized by the Fayetteville Observer as one of the area's rising leaders under the age of 40. Rev Farrow has a broad range of experiences in ministry, which have formed the basis for his passion for ministry and missions; however, the joy of his life is his family. Rev. Farrow is married to Kembrie Farrow, who works as a social worker in the Charlotte-Mecklenburg School System. They are proud parents of three children, Kadence, Karson, and Kailand.
        </p>
      </div>
    </div>
  </div>

  <hr>

  <div class="px-4 pt-5 my-5 text-center border-bottom">
    <h1 class="display-4 fw-bold">Why <i>Last Mile of the Way</i>?</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4"><strong>Last Mile of The Way</strong> is a beloved hymn in the African American
        church context. It was made especially popular in 1970 <a target="_blank" href="https://youtu.be/bxTh3KShLjs"
        title="Sam Cooke - The Last Mile of the Way">when Sam Cooke recorded it</a>. I come
        from a singing family. My dad and his siblings are often asked to sing at funerals. When my
        uncle is asked to do a solo, it is always <strong>Last Mile of The Way</strong>. The hymn
        speaks of coming to the end of one's journey and the Christian hope of standing before
        Christ; however, I use these words to call attention to what I believe is the sacred
        obligation of the church, which is to come alongside, "weep with those who weep," and
        respond to the impact of each loss. As Thomas Long notes in his book,
        <i>Accompany Them with Singing</i>, "Underlying all Christian funerals is a very basic
        action shared by all humanity. Someone has died, and the body must be cared for and carried
        to the place of burial, the place of farewell." I invite not only pastoral leaders but
        laity to discover anew how the church can be the presence of Christ with mourners as they
        take their loved ones the last mile of the way.</p>
    </div>
    <div class="overflow-hidden" style="max-height: 30vh;">
      <div class="container px-5">
        <img src="{{ url('images/man-with-questions.jpeg') }}" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Man with questions photo" width="700" height="500" loading="lazy">
      </div>
    </div>
  </div>
@endsection
