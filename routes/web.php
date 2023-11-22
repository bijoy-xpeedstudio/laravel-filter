<?php

use App\Http\Controllers\FilterController;
use App\Http\Controllers\ResponseController;
use App\Models\Category;
use App\Models\Department;
use App\Models\Document;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/response', [ResponseController::class, 'getResponse']);
Route::get('/attribute', function () {
    // return Document::$filter_attribute;
    $data = new Document;
    return $data->getFilterData();
});
Route::get('/attribute1', function () {
    $data = new Document;
    return $data->filter();
});

Route::get('/aaaa', function () {
    dd('sdafsdf');
    //['title', 'description', 'status', 'user_id', 'category_id'];
    $user = new Post();
    $user->title = 'bijoy';
    $user->description = 'bijoy@mail.com';
    $user->status = 'Active';
    $user->user_id = 'asdfsdfsdf';
    $user->category_id = 'sdsdfsdfsdfdf';
    $user->save();

    // dd($user);
    // $data = Post::all();
    // foreach ($data as $key => $value) {
    //     $value->user_id = '6542113377fe565488073882';
    //     $value->save();
    // }
});

Route::get('test-check', function () {
    $model = new Post();
    return $model->compare();
    dd($model, $this);
});

Route::get('fix-db', function () {
    $posts = Category::all();
    $array = 'Admin Big Data
Ansible Operations Engineer
Artifactory Administrator
Artificial intelligence / Machine Learning Engineer
Artificial Intelligence / Machine Learning Leader
Artificial Intelligence / Machine Learning Sr.Leader
Artificial intelligence Architect
Artificial Intelligence Researcher
Big Data Architect
Big Data Engineer
Big Data Specialist
Build and Release Engineer
Build Engineer
Chef Operations Engineer
Data Analysts
Data Architect
DevOps Architect
DevOps Engineer
ELK Engineer
Gerrit Administrator
Gerrit Administrator
Jenkins Engineer
Jira Administrator
Kubernetes Operations Engineer
Machine learning Architect
Machine Learning Engineer
Operations Engineer
Principle Engineer in Artificial Intelligence
Principle Engineer in Big Data
Principle Engineer in Data Analysis
Principle Engineer in Machine Learning
Production Support Engineer
Puppet Operations Engineer
Senior Build and Release Engineer
Senior Build Engineer
Senior DevOps Engineer
Senior Site reliability Engineer
Site Reliability Engineer (Kubernetes – Docker)
Splunk Engineer
.NET Developer
ACCESSIBILITY SPECIALIST
AGILE PROJECT MANAGER
Android Developer
Ansible Automation Engineer
AppDynamics Engineer
Application Security Engineer
Artifactory Engineer
Artificial Intelligence (AI) / Machine Learning Engineer
AWS DevOps Engineer
AWS Solutions Architect
Azure DevOps Engineer
Bamboo Engineer
Bitbucket Engineer
Blockchain Developer
BUSINESS SYSTEMS ANALYST
C# Developer
Chef InSpec Engineer
Cloud administrator
CLOUD ARCHITECT
Cloud architect
Cloud automation engineer
Cloud engineer
Cloud network engineer
Cloud Security Engineer
CNC Programmer
Coder
COMPUTER GRAPHICS ANIMATOR
Computer Hardware Engineer
Computer Network Architect
Computer Programmer
Computer Research Scientist
Computer Systems Analyst
Confluence Engineer
Consul Engineer
Coverage.py Engineer
DATA ANALYST
Data Analyst
DATA ARCHITECT
Data Engineer
DATA MODELER
DATA SCIENTIST
Data Scientist
DATABASE ADMINISTRATOR
Database Administrator
Datadog Engineer
Developer
DevOps Architect
DevOps Engineer
DevOps Engineer
DEVOPS MANAGER
DevSecOps Architect
DevSecOps Engineer
Director of Engineering
Docker Engineer
ELK Engineer
Embedded Software Engineer
Entry Level Developer
Entry Level Network Engineer
Entry Level Programmer
Entry Level Software Developer
Entry Level Software Engineer
Entry Level Web Developer
Envoy Engineer
Falco Engineer
FluentD Engineer
Fortify Engineer
FRAMEWORKS SPECIALIST
Front End Developer
Front End Web Developer
FRONT-END DESIGNER
FRONT-END DEVELOPER
Full Stack Developer
Full Stack JAVA Developer/Programmer/Engineer
Full Stack Python Developer/Programmer/Engineer
FULL-STACK DEVELOPER
Game Developer
GAME DEVELOPER
GCP DevOps Engineer
Gerrit Engineer
Git Engineer
Github Engineer
GitLab Engineer
GitLab Engineer
Gradle Engineer
Grafana Engineer
Groovy Engineer
INFORMATION ARCHITECT
Information Security Analyst
INTERACTION DESIGNER
IOS Developer
Istio Engineer
IT Manager
JaCoCO Engineer
Java Developer
Java Developer
JavaScript Developer
Jenkins Engineer
JIRA Engineer
Jr Developer
Junior Developer
Junior Front End Developer
Junior IOS Developer
Junior Software Developer
Junior Software Engineer
Junior Web Developer
JUnit Engineer
kubernetes Administrator
Kubernetes Engineer
Machine Learning Engineer
MAVEN Engineer
Micro services / API Lead Designer
MOBILE APP DEVELOPER
Mobile Application Developer
MOBILE DEVELOPER
Mulesoft Developer
Nagios Engineer
Network and Systems Administrator
Network Engineer
New Grad Software Engineer
New Relic Engineer
Nexus Engineer
Nomad Engineer
Notary Engineer
Octopus Deploy Engineer
OpenShift Engineer
OpenStack Engineer
Oracle Developer
Oracle SQL Developer
Packer Engineer
PHP Developer
PHP Developer
Powershell Engineer
PRODUCT MANAGER
Programmer
Programmer Analyst
Prometheus Engineer
Puppet Engineer
PyTest Engineer
Python Developer
PYTHON DEVELOPER
Python Developer
QA (QUALITY ASSURANCE) SPECIALIST
QA Engineer
React Developer
Robotics Engineer
RUBY ON RAILS DEVELOPER
Salesforce Developer
Search Engine Optimization
SECURITY SPECIALIST
Selenium Engineer
Senior Ansible Development Engineer
Senior Cloud Architect
Senior DevOps Architect
Senior DevOps Engineer
Senior DevSecOps Architect
Senior DevSecOps Engineer
Senior SRE Architect
Senior SRE Engineer
Sharepoint Developer
Software Developer
SOFTWARE DEVELOPERS
Software Engineer
Software Engineer
SonarQube Engineer
Splunk Engineer
Splunk Enterprise Security Engineer
SQL Developer
SRE Architect
SRE Engineer
SYSTEMS ADMINISTRATOR
SYSTEMS ENGINEER
TeamCity Engineer
Tech Sales Engineer
TECHNICAL ACCOUNT MANAGER
TECHNICAL LEAD
Terraform Engineer
TFS Engineer
Twistkock Engineer
UDeploy Engineer
UI DESIGNER
UI Developer
Unity Developer
UX DESIGNER
Vault Engineer
Web Designer (UI/UX Designer)
Web Developer
Web Developer
WordPress Developer
WORDPRESS DEVELOPER
XL Deploy Engineer
Zabbix Engineer';
    $department = explode("\n", $array);

    foreach ($department as $value) {
        $model = new Department();
        $model->name = $value;
        $model->status = true;
        $model->save();
    }

    return Department::all();
});

Route::get('/category-fix', function () {
    $data = Post::all();
    $department = Department::all()->toArray();
    foreach ($data as $key => $value) {
        $array_rand = array_rand($department);
        $value->department_id = $department[$array_rand]['_id'];
        $value->save();
    }
});

Route::get('data', [FilterController::class, 'feedData']);
Route::get('hi', function () {
    dd('hi');
});
