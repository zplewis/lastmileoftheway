@extends('layout')

@section('content')
<div class="px-4 py-5 my-5 text-center" id="about-this-site">
    <h1 class="display-5 fw-bold">About this site</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead"><i>Last Mile of the Way</i> is an interactive website designed not only to help
          those who find themselves in the unfamiliar position of having to plan a funeral or
          memorial service but is also a tool for those who desire to be more intentional and
          involved on the worship planning side.</p>
      <p class="lead"><i>Last Mile of the Way</i> can also be used
          as a church counterpart to a pre-need contract, a service offered by most funeral homes
          which allows people to decide on which services they want in advance. This website allows
          you to make your requests known. Use this site to determine a liturgy based on the type
          of service you envision, save or print a copy of your order of service, and place it with
          other important documents intended for those who will be tasked with making your final
          arrangements.</p>
    </div>
</div>

<div class="container col-xxl-8 px-4 py-5" id="about-pastor-farrow">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="{{ url('images/about-pastor-farrow-white.jpeg') }}" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3">About Pastor Farrow</h1>
        <p class="lead">Reverend Thomas Farrow, Jr. currently serves as Senior Pastor of
            <a href="https://reederministries.org/" title="Reeder Memorial Baptist Church">Reeder
            Memorial Baptist Church of Charlotte, NC</a>. Prior to coming to Charlotte, Rev. Farrow
            served as Senior Pastor of First Baptist Church Clinton in Clinton, NC for six years.
            He holds a Bachelor of Science degree in Business Administration and a Master of Arts
            degree in Mental Health Counseling from North Carolina Central University. In December
            of 2015, he completed a Master of Divinity Degree from Campbell University. Rev. Farrow
            is now studying at Campbell University to obtain his Doctorate of Ministry Degree.
            He is active in the United Missionary Baptist Association as well as the North Carolina
            Baptist Convention, where he serves as the Coordinator for the Young Pastors Division of
            the Ministers Council. Rev. Farrow has been recognized by the Fayetteville Observer as
            one of the area's rising leaders under the age of 40.</p>
      </div>
    </div>
  </div>

  <hr>

  <div class="px-4 pt-5 my-5 text-center border-bottom">
    <h1 class="display-4 fw-bold">Why <i>Last Mile of the Way</i>?</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4"><strong>Last Mile of The Way</strong> is a beloved hymn in the African American
        church context. It was made especially popular in 1970 when Sam Cooke recorded it. I come
        from a singing family. My dad and his siblings are often asked to sing at funerals. When my
        uncle is asked to do a solo, it is always <strong>Last Mile of The Way</strong>. The hymn
        speaks of coming to the end of one's journey and the Christian hope of standing before
        Christ. I use these words to highlight what I believe the</p>
    </div>
    <div class="overflow-hidden" style="max-height: 30vh;">
      <div class="container px-5">
        <img src="{{ url('images/man-with-questions.jpeg') }}" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
      </div>
    </div>
  </div>
@endsection
