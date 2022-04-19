public function rate(Request $request)
{
$user = Auth::user();
if($user->hasRole(['Internal_student','External_student']))
{
$student_id = $user->id;
$course_id = $request->course_id;
$rate = $request->rate;
if($rate>=1 || $rate<=5)
{
$reg = Course_Student::where('course_id',$course_id)->where('student_id',$student_id)->first();
if($reg)
{
$reg->rate = $request->rate;
$reg->save();
$course = Course::findOrFail($course_id);
$StudentRates = $course->AcceptedStudents;
$rates = [
0=>0,
1=>0,
2=>0,
3=>0,
4=>0,
5=>0,
];
$total_rate = 0;
$n = 0;
foreach ($StudentRates as $student) {
if($student->rate > 0)
{
$total_rate += $student->rate;
$n++;
$rates[0] += 1;
$rates[$student->rate] += 1;
}
}
$course_rate = $total_rate/$n;
$course->rate = $course_rate;
$course->save();
$course->rates = $rates;
// $response = "{message:\"Rate Done Successfully\",code:1,data:{course_rate:".$course_rate."}}";
return  response()->json([
'success'=>'Rate Done Successfully',
'data'=>$course
]);
// return $response;
}
$response = "You're not registered in this course";
return $response;
}
$response = "Rate should be between 1 and 5";
return $response;
}
$response = "You're not allowed to rate courses";
return $response;
}


<!doctype html>
<html class="no-js" lang="">

@include('FrontEnd.Public.header_stream')

<!-- Main Body Area End Here -->
<body>

@include('FrontEnd.Public.navbar')

<!-- Inner Page Banner Area Start Here -->
<div class="inner-page-banner-area" style="background-image: url('{{asset('img/banner/5.jpg')}}');">
    <div class="container">
        <div class="pagination-area">
            <h1>{{$course->title}}</h1>
            <ul>
                <li><a href="{{route('/')}}">Home</a> -</li>
                <li>Courses Details</li>
            </ul>
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
@if ($course)
    <div class="courses-page-area5">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                    <div class="course-details-inner">
                        <h2 class="title-default-left title-bar-high">{{$course->title}}</h2>
                        <p>{{$course->description}}</p>
                        <img src="{{url('/photos/courses')}}/{{$course->image}}" class="img-responsive" alt="course">
                        <div class="course-details-tab-area">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <ul class="course-details-tab-btn">
                                        <li class="active"><a href="#description" data-toggle="tab"
                                                              aria-expanded="false">Description</a></li>
                                        <li><a href="#curriculum" data-toggle="tab" aria-expanded="false">Topics</a>
                                        </li>
                                        <li><a href="#lecturer" data-toggle="tab" aria-expanded="false">Lecturer</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active in" id="description">
                                            <h3 class="sidebar-title">Course Description</h3>
                                            <p>{{$course->description}}</p>
                                            <h3 class="sidebar-title">Skills</h3>
                                            <ul class="learning-outcomes">
                                                <li>{{$course->skills}}</li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane fade" id="curriculum">
                                            <h3 class="sidebar-title">{{$course->category->name}}
                                                : {{$course->title}}</h3>
                                            <div class="panel-group curriculum-wrapper" id="accordion">
                                                @foreach ($course->topics as $topic)
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <div class="panel-title">
                                                                <a aria-expanded="false"
                                                                   class="accordion-toggle collapsed"
                                                                   data-toggle="collapse" data-parent="#accordion"
                                                                   href="#collapse{{$topic->id}}">
                                                                    <ul>
                                                                        <li><i class="fa fa-file-o"
                                                                               aria-hidden="true"></i></li>
                                                                        <li>{{$topic->name}}</li>
                                                                        <li>{{$topic->description}}</li>
                                                                        <li><i class="fa fa-clock-o" aria-hidden="true"><span> {{$topic->contents()->count()}} Contents</span></i>
                                                                        </li>
                                                                    </ul>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div aria-expanded="false" id="collapse{{$topic->id}}"
                                                             role="tabpanel" class="panel-collapse collapse">
                                                            <div class="panel-body">
                                                                {{$topic->description}}
                                                                <ul>
                                                                    @foreach($topic->contents as $content)
                                                                        <hr>
                                                                        <li><a href="
                                                                                    @role(['Internal_student','External_student'])
                                                                                        @if($course->accept)
                                                                            {{url('/course_page')}}/{{$content->id}}
                                                                            @endif
                                                                                @endrole
                                                                            #">{{$content->title}}</a></li>

                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="lecturer">
                                            <div class="course-details-skilled-lecturers">
                                                <ul>
                                                    <li>
                                                        <div class="skilled-lecturers-img">
                                                            <a href="#"><img
                                                                    src="{{url('photos/profiles')}}/{{$course->lecturer->image}}"
                                                                    class="img-responsive" alt="skilled"></a>
                                                        </div>
                                                        <div class="skilled-lecturers-content">
                                                            <h4><a href="#">{{$course->lecturer->full_name()}}</a></h4>
                                                            <p>Lecturer At
                                                                @foreach ($course->lecturer->LecturerRegistredAtCollage as $col)
                                                                    {{$col->collage->name_en}} Collage
                                                                    @if (!$loop->last)
                                                                        , &nbsp;
                                                                    @endif
                                                                @endforeach
                                                            </p>
                                                        </div>
                                                        <div class="skilled-lecturers-schedule">
                                                            <ul>
                                                                <li>
                                                                    <h4>Teach</h4>
                                                                    <p>{{$course->lecturer->courses()->count()}}
                                                                        Courses</p>
                                                                </li>
                                                                <li>
                                                                    <h4>Contact</h4>
                                                                    <p>{{$course->lecturer->email}}</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="related-courses-title-area">
                        <h3>Related Courses</h3>
                    </div>
                    <div id="shadow-carousel" class="related-courses-carousel">
                        <div class="rc-carousel" data-loop="true" data-items="3" data-margin="15" data-autoplay="false"
                             data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true"
                             data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="true"
                             data-r-x-small-dots="false" data-r-x-medium="2" data-r-x-medium-nav="true"
                             data-r-x-medium-dots="false" data-r-small="1" data-r-small-nav="true"
                             data-r-small-dots="false" data-r-medium="2" data-r-medium-nav="true"
                             data-r-medium-dots="false" data-r-large="3" data-r-large-nav="true"
                             data-r-large-dots="false">
                            @foreach ($related_courses as $rCourse)
                                <div class="courses-box1">
                                    <div class="single-item-wrapper">
                                        <div class="courses-img-wrapper hvr-bounce-to-right">
                                            <img class="img-responsive"
                                                 src="{{url('/photos/courses')}}/{{$rCourse->image}}" alt="courses">
                                            <a href="{{url('/single-course')}}/{{$rCourse->id}}"><i class="fa fa-link"
                                                                                                    aria-hidden="true"></i></a>
                                        </div>
                                        <div class="courses-content-wrapper">
                                            <h3 class="item-title"><a
                                                    href="{{url('/single-course')}}/{{$rCourse->id}}">{{$rCourse->title}}</a>
                                            </h3>
                                            <p class="item-content">{{$rCourse->description}}</p>
                                            <ul class="courses-info">
                                                <li>{{$rCourse->duration}}
                                                    <br><span>Time</span></li>
                                                <li>{{($rCourse->cost == 0)? 'Free' : '$'.$rCourse->cost}}
                                                    <br><span>Cost</span></li>
                                                <li>{{$rCourse->rate}}
                                                    <br><span>Rate</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="sidebar">
                        <div class="sidebar-box">
                            <div class="sidebar-box-inner" id="cou">
                                <h3 class="sidebar-title">Course Price</h3>
                                <div class="sidebar-course-price">
                                    <span>{{($course->cost == 0)? 'Free' : '$'.$course->cost}}</span>
                                    @role(['Internal_student','External_student'])
                                    @if($course->accept)
                                        @if($course->register->status == "Done")
                                            <p>You're Done with this course</p>
                                        @elseif($course->register->status == "Active")
                                            <p>You're Active in this course at <a
                                                    href="{{url('/course_page')}}/{{$course->accept->progress}}">{{$course->accept->content->title}}</a>
                                            </p>
                                        @endif
                                        <p>You rated this: <b class="my-rate">{{$course->accept->rate}}</b>/5</p>
                                        <div class="sidebar-course-reviews">
                                            <p>Rate This Course:</p>
                                            <ul>
                                                <li class="rate-star" title="1" data-r-val="1"><i class="fa
                                                            @if($course->accept->rate >= 1)
                                                        fa-star
                                                        @else
                                                        fa-star-o
                                                        @endif
                                                        " aria-hidden="true"></i></li>
                                                <li class="rate-star" title="2" data-r-val="2"><i class="fa
                                                            @if($course->accept->rate >= 2)
                                                        fa-star
@else
                                                        fa-star-o
@endif
                                                        " aria-hidden="true"></i></li>
                                                <li class="rate-star" title="3" data-r-val="3"><i class="fa
                                                            @if($course->accept->rate >= 3)
                                                        fa-star
@else
                                                        fa-star-o
@endif
                                                        " aria-hidden="true"></i></li>
                                                <li class="rate-star" title="4" data-r-val="4"><i class="fa
                                                            @if($course->accept->rate >= 4)
                                                        fa-star
@else
                                                        fa-star-o
@endif
                                                        " aria-hidden="true"></i></li>
                                                <li class="rate-star" title="5" data-r-val="5"><i class="fa
                                                            @if($course->accept->rate == 5)
                                                        fa-star
@else
                                                        fa-star-o
@endif
                                                        " aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    @elseif($course->register)
                                        <p>Your request has been sent before and it's {{$course->register->status}}</p>
                                    @else
                                        <a class="enroll-btn" href="#cou" id="register-button" onclick="openForm()">Register
                                            In THis Course</a>
                                        <div class="register-form" id="register-form" style="display: none;">
                                            <div class="title-default-left-bold">Send Register Request</div>
                                            <form method="POST" action="{{ route('student.reg') }}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @if(($course->cost != 0))
                                                    <label>Payment Check</label>
                                                    <input type="file" name="payment_check"
                                                           class="form-control{{ $errors->has('payment_check') ? ' is-invalid' : '' }}"
                                                           accept=".pdf" id="payment_check" required autofocus/>

                                                    @if ($errors->has('payment_check'))
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('payment_check') }}</strong>
                                                            </span>
                                                    @endif
                                                @endif
                                                <input type="hidden" name="course_id" value="{{$course->id}}"/>
                                                <button class="default-big-btn" type="submit"
                                                        style="width: auto;padding: 6px 20px;" value="Register">Register
                                                </button>
                                                <style>
                                                    .form-cancel:hover {
                                                        cursor: pointer;
                                                    }
                                                </style>
                                                <a class="default-big-btn form-cancel"
                                                   style="width: auto;padding: 6px 20px;"
                                                   onclick="closeForm()">Cancel</a>
                                            </form>
                                        </div>
                                    @endif
                                    @endrole
                                    {{-- <a href="#" class="download-btn">Download PDF</a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-box">
                            <div class="sidebar-box-inner">
                                <h3 class="sidebar-title">Course Reviews</h3>
                                <div class="sidebar-course-reviews">
                                    <h4>Average Rating<span class="course_rate">{{$course->rate}}</span></h4>
                                    <ul>
                                        <li><i class="fa
                                                @if($course->rate >= 1)
                                                fa-star
                                                @elseif($course->rate < 2 && $course->rate > 0)
                                                fa-star-half-o
                                                @else
                                                fa-star-o
                                                @endif" aria-hidden="true"></i></li>
                                        <li><i class="fa
                                                @if($course->rate >= 2)
                                                fa-star
                                                @elseif($course->rate < 3 && $course->rate > 1)
                                                fa-star-half-o
                                                @else
                                                fa-star-o
                                                @endif" aria-hidden="true"></i></li>
                                        <li><i class="fa
                                                @if($course->rate >= 3)
                                                fa-star
                                                @elseif($course->rate < 4 && $course->rate > 2)
                                                fa-star-half-o
                                                @else
                                                fa-star-o
                                                @endif" aria-hidden="true"></i></li>
                                        <li><i class="fa
                                                @if($course->rate >= 4)
                                                fa-star
                                                @elseif($course->rate < 5 && $course->rate > 3)
                                                fa-star-half-o
                                                @else
                                                fa-star-o
                                                @endif" aria-hidden="true"></i></li>
                                        <li><i class="fa
                                                @if($course->rate >= 5)
                                                fa-star
                                                @elseif($course->rate < 6 && $course->rate > 4)
                                                fa-star-half-o
                                                @else
                                                fa-star-o
                                                @endif" aria-hidden="true"></i></li>
                                    </ul>
                                    <div class="skill-area">
                                        <div class="progress star5">
                                            <div class="lead">5 Stars</div>
                                            <div data-wow-delay="1.2s" data-wow-duration="1.5s"
                                                 style="width: {{($course->rates[0] > 0)?($course->rates[5]/$course->rates[0])*100 : 0}}%; visibility: visible; animation-duration: 1.5s; animation-delay: 1.2s; animation-name: fadeInLeft;"
                                                 data-progress="{{($course->rates[0] > 0)?($course->rates[5]/$course->rates[0])*100 : 0}}%"
                                                 class="progress-bar wow fadeInLeft  animated"></div>
                                            <span>{{$course->rates[5]}}</span>
                                        </div>
                                        <div class="progress star4">
                                            <div class="lead">4 Stars</div>
                                            <div data-wow-delay="1.2s" data-wow-duration="1.5s"
                                                 style="width: {{($course->rates[0] > 0)?($course->rates[4]/$course->rates[0])*100 : 0}}%; visibility: visible; animation-duration: 1.5s; animation-delay: 1.2s; animation-name: fadeInLeft;"
                                                 data-progress="{{($course->rates[0] > 0)?($course->rates[4]/$course->rates[0])*100 : 0}}%"
                                                 class="progress-bar wow fadeInLeft  animated"></div>
                                            <span>{{$course->rates[4]}}</span>
                                        </div>
                                        <div class="progress star3">
                                            <div class="lead">3 Stars</div>
                                            <div data-wow-delay="1.2s" data-wow-duration="1.5s"
                                                 style="width: {{($course->rates[0] > 0)?($course->rates[3]/$course->rates[0])*100 : 0}}%; visibility: visible; animation-duration: 1.5s; animation-delay: 1.2s; animation-name: fadeInLeft;"
                                                 data-progress="{{($course->rates[0] > 0)?($course->rates[3]/$course->rates[0])*100 : 0}}%"
                                                 class="progress-bar wow fadeInLeft  animated"></div>
                                            <span>{{$course->rates[3]}}</span>
                                        </div>
                                        <div class="progress star2">
                                            <div class="lead">2 Stars</div>
                                            <div data-wow-delay="1.2s" data-wow-duration="1.5s"
                                                 style="width: {{($course->rates[0] > 0)?($course->rates[2]/$course->rates[0])*100 : 0}}%; visibility: visible; animation-duration: 1.5s; animation-delay: 1.2s; animation-name: fadeInLeft;"
                                                 data-progress="{{($course->rates[0] > 0)?($course->rates[2]/$course->rates[0])*100 : 0}}%"
                                                 class="progress-bar wow fadeInLeft  animated"></div>
                                            <span>{{$course->rates[2]}}</span>
                                        </div>
                                        <div class="progress star1">
                                            <div class="lead">1 Stars</div>
                                            <div data-wow-delay="1.2s" data-wow-duration="1.5s"
                                                 style="width: {{($course->rates[0] > 0)?($course->rates[1]/$course->rates[0])*100 : 0}}%; visibility: visible; animation-duration: 1.5s; animation-delay: 1.2s; animation-name: fadeInLeft;"
                                                 data-progress="{{($course->rates[0] > 0)?($course->rates[1]/$course->rates[0])*100 : 0}}%"
                                                 class="progress-bar wow fadeInLeft  animated"></div>
                                            <span>{{$course->rates[1]}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-box">
                            <div class="sidebar-box-inner">
                                <h3 class="sidebar-title">Asked Any Question?</h3>
                                <div class="sidebar-question-form">
                                    <form id="question-form">
                                        <fieldset>
                                            <div class="form-group">
                                                <input type="text" placeholder="Name*" class="form-control" name="name"
                                                       id="form-name" data-error="Name field is required" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" placeholder="Email*" class="form-control"
                                                       name="email" id="form-email" data-error="Email field is required"
                                                       required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="form-group">
                                                <textarea placeholder="Message*" class="textarea form-control"
                                                          name="message" id="sidebar-form-message" rows="3" cols="20"
                                                          data-error="Message field is required" required></textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="default-full-width-btn">Send</button>
                                            </div>
                                            <div class='form-response'></div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-box">
                            <div class="sidebar-add-area overlay-primaryColor">
                                <img src="{{asset('img/banner/7.jpg')}}" class="img-responsive" alt="banner">
                                <a href="#" class="sidebar-ghost-btn">Apply Now!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@include('FrontEnd.Public.footer')

@include('FrontEnd.Public.footer_stream')

<script>

    $('.rate-star').hover(function () {
        $(this).prevAll().find('i').removeClass('fa-star-o');
        $(this).find('i').removeClass('fa-star-o');
        $(this).prevAll().find('i').addClass('fa-star');
        $(this).find('i').addClass('fa-star');
        $(this).css('cursor', 'pointer');
    }, function () {
        var rate = $('.my-rate').html();
        $('.rate-star').each(function (i) {
            if (i <= rate - 1) {
                $(this).find('i').removeClass('fa-star-o')
                $(this).find('i').addClass('fa-star');
            } else {
                $(this).find('i').removeClass('fa-star');
                $(this).find('i').addClass('fa-star-o');

            }
        });
        $(this).css('cursor', 'default');
    });

</script>
<script>
    $('.rate-star').click(function () {
        var rate = $(this).attr('data-r-val');
        var course = {{$course->id}};
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            method: "POST",
            url: "{{route('rate')}}",
            dataType: "json",
            data: {
                _token: CSRF_TOKEN,
                course_id: course,
                rate: rate
            },
            success: function (response) {
                console.log(response);
                $('.rate-star').each(function (i) {
                    if (i <= rate - 1) {
                        $(this).find('i').removeClass('fa-star-o')
                        $(this).find('i').addClass('fa-star');
                    } else {
                        $(this).find('i').removeClass('fa-star');
                        $(this).find('i').addClass('fa-star-o');

                    }
                });
                $('.my-rate').html(rate);
                var newRate = response.data.rate;
                $('.course_rate').html(newRate);
                for (var i = 1; i < 6; i++) {
                    $('.star' + i).find('span').html(response.data.rates[i]);
                    var width = 0;
                    if (response.data.rates[0] > 0)
                        width = (response.data.rates[i] / response.data.rates[0]) * 100 + '%';
                    $('.star' + i).find('.progress-bar').css("width", width);
                    $('.star' + i).find('.progress-bar').attr("data-progress", width);
                }

            },
            error: function (e) {
                alert(e.responseText);
            }
        });
    });
</script>
<script>
    function openForm() {
        document.getElementById("register-form").style.display = "block";
    }

    function closeForm() {
        document.getElementById("register-form").style.display = "none";
    }
</script>
</body>

</html>



