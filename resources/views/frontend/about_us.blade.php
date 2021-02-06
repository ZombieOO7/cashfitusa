@extends('frontend.layouts.default')
@section('content')
@section('title', @$cms->page_title)
<link rel="stylesheet" href="{{asset('/frontend/css/newstyle.css')}}">
<div class="mt-0 mb-0">
    <div class="">
        <!-- <h2>
            {{@$cms->page_title}}
        </h2>
        {!! @$cms->page_content !!} -->

        <div class="aboutmain">

        	<div class="aboutsec aboutsecone">
        		<div class="container">
        		<div class="headTitle">
        			<h5 class="title">About Us</h5>
        		</div>
        		<div class="aboutconinfomain">
        			<div class="abconinfleft abcon-info borderfull">
        				<div class="abconinfotit">
        					<h5 class="title">New Loan Support Center.</h5>
        				</div>
        				<h6 class="assititle">For Assistance with:</h6>
        				<div class="coninfo">
        					<ul>
        						<li>
        							<h6 class="numtitle">General Department</h6>
        							<span><i class="icon fa fa-phone"></i><a href="tel:+1 123-456-7890">+1 123-456-7890</a></span>
        						</li>
        						<li>
        							<h6 class="numtitle">Verification Department</h6>
        							<span><i class="icon fa fa-phone"></i><a href="tel:+1 123-456-7890">+1 123-456-7890</a></span>
        						</li>
        						<li>
        							<h6 class="numtitle">Funding Department</h6>
        							<span><i class="icon fa fa-phone"></i><a href="tel:+1 123-456-7890">+1 123-456-7890</a></span>
        						</li>
        					</ul>
        					<div class="coninfoemail">
        					<span><i class="icon fa fa-user"></i><a href="mailto:support@RapidcashAmerica.com">support@RapidcashAmerica.com</a></span>
        					</div>
        				</div>
        			</div>
        			<div class="abconinfright abcon-info">
        				<div class="abconinfotit">
        					<h5 class="title">Remote Working Support Center.</h5>
        				</div>
        				<h6 class="assititle">For Assistance with:</h6>
        				<div class="coninfo">
        					<ul>
        						<li>
        							<h6 class="numtitle">General Department</h6>
        							<span><i class="icon fa fa-phone"></i><a href="tel:+1 123-456-7890">+1 123-456-7890</a></span>
        						</li>
        					</ul>
        					<div class="coninfoemail">
        					<span><i class="icon fa fa-user"></i><a href="mailto:support@RapidcashAmerica.com">support@RapidcashAmerica.com</a></span>
        					</div>
        				</div>
        			</div>
        		</div>
        		</div>
        	</div>

        	<div class="aboutsec aboutsectwo">
        		<div class="container">
        		<div class="headTitle">
        			<h5 class="title">Hours of <br> Operation.</h5>
        		</div>
        		
                <div class="timedaymain">
                    <div class="timedaybox">
                        <ul class="headtimeday">
                            <li class="daytitle">DAY</li>
                            <li class="timetitle">TIME</li>
                        </ul>
                        <ul class="daytimeinfo">
                            <li>Monday</li>
                            <li>9:00am-7:00pm EST</li>
                            <li>Tuesday</li>
                            <li>9:00am-7:00pm EST</li>
                            <li>Wednesday</li>
                            <li>9:00am-7:00pm EST</li>
                            <li>Thrusday</li>
                            <li>9:00am-7:00pm EST</li>
                            <li>Friday</li>
                            <li>9:00am-7:00pm EST</li>
                            <li>Saturday</li>
                            <li>9:00am-5:00pm EST</li>
                        </ul>
                    </div>
                </div>

        		</div>
        	</div>



        </div>

    </div>
</div>
@endsection
