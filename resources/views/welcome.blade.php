@extends('layouts.app')

@section('title')
    Welcome
@stop

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <div>
                    <img src="/img/ip-logo2.png" alt="test" style="width:300px;height:250px; margin-top:20px">
                </div>
            </div>

            <div class="col-md-6">

                <h2>Welcome to iPlan</h2>

                <div class="introtext">
                    <p>
                        iPlan help you provide for the perfect starting point and help you manage your next big projects easily.
                        It provide you a tool to monitor and control your task on the projects.
                    </p>
                </div>

                <div class="introtext">
                    <br>
                    <h3>Description</h3>
                    <p>
                        iPlan is a Web Application that will allow software companies or individual developers in the process
                        of building and maintaining any kind of software project.
                        The aim of iPlan is to provide a management platform to allow developers to collaborate on their respective
                        projects.

                    </p>
                </div>
            </div>
        </div>

    </div>
    <!--/.container-->

    <div class="banner"></div>

    <div class="container">
        <div class="row" style="margin-top:50px;">
            <div class="col-md-4">
                <div class="introtextbody">
                    <i class="fa fa-lock" style="font-size:40px;" aria-hidden="true"></i>
                    <h3>Authentication</h3>
                    <p>Authentication, registration, and password reset are facilities.
                       Its never been faster to get started building your dreams.Registration is confirmed ia
                        a mail sent to the user to verify that a person does not already have an account and
                        to ensure a safer way to connect its users.
                    </p>
                </div>

                <br><br>

                <div>
                    <i class="fa fa-cog" style="font-size:40px;" aria-hidden="true"></i>
                    <h3>Admin control</h3>
                    <p>With the admin control on projects that you have created, you are able to easily manage those
                        projects and make sure of that the deadlines set for it is successful. You have the ability to
                        set work items ans assigned them to other members and ability to add and remove any
                        member on the project.
                    </p>
                </div>

            </div>

            <div class="col-md-4">
                <div>
                    <i class="fa fa-users " style="font-size:40px;" aria-hidden="true"></i>
                    <h3>Team work</h3>
                    <p>Wih iPlan, it becomes more easy to manage and keep track of work done by other and by oneself.
                    iPlan encourages and facilitates team work by providing the right and appropriate tool needed in
                    an working environment. Users and members of a specific project can keep track and make valuable
                    suggestion.</p>
                </div>

                <br><br>

                <div>
                    <i class="fa fa-plus" style="font-size:40px;" aria-hidden="true"></i>
                    <h3>Create work item</h3>
                    <p>It also allows members with the authorised rights to create work items on projects. Those work
                    items help in the better progression and help with the assignment of task to each individual
                    on the project. Work items are equipped with a section that let the assigned user know in what
                    time the project should be completed. </p>
                </div>


            </div>

            <div class="col-md-4">
                <div>
                    <i class="fa fa-bell"  style="font-size:40px;" aria-hidden="true"></i>
                    <h3>Notifications</h3>
                    <p>iplan provides a notification system to help admin as well as users to keep up to dates
                    wit their projects. Users shall be notify when a new work item has been assigned to them and
                    also let them know that each work item has been set for a period of time which needs to be
                    carried out so te project can be completed.</p>
                </div>

                <br><br>

                <div>
                    <i class="fa fa-comment" style="font-size:40px;" aria-hidden="true"></i>
                    <h3>Comments</h3>
                    <p>Comments are available on work item to let the admins know what task has been carried out and
                    how it been carried out. Also comments can be made by other members of the project to report
                    any bug or to see what difficulties other members have in doing their tasks.</p>
                </div>

            </div>
        </div>

    </div>

    <div class="footer">
        @include('layouts.footer')
    </div>

    <!--/.container-->
@stop
