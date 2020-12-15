<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CH;
use App\User; 
use App\AuctionItem;
use App\Auction;
use App\Contacts;
use App\Bidding;
use App\News; 
use App\Role; 
use App\Subscriber; 
use DB;
use Auth;
use App\Charts\UserChart;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
class DashboardController extends Controller
{
    public function index() {
       


   
        // $usersChart = new UserChart;
        // $usersChart->labels(['Jan', 'Feb', 'Mar']);
        // $usersChart->dataset('Users by trimester', 'line', [10, 25, 13])
        //     ->color("rgb(255, 99, 132)")
        //     ->backgroundcolor("rgb(255, 99, 132)");


//             $today_users = User::whereDate('created_at', today())->count();
// $yesterday_users = User::whereDate('created_at', today()->subDays(1))->count();
// $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();

// $usersChart = new UserChart;
// $usersChart->labels(['2 days ago', 'Yesterday', 'Today']);
// $usersChart->dataset('My dataset', 'line', [$users_2_days_ago, $yesterday_users, $today_users]);
        
$chart_options = [
           'chart_title' => 'Users by months',
    'report_type' => 'group_by_date',
    'model' => 'App\User',
    'group_by_field' => 'created_at',
    'group_by_period' => 'week',
    'chart_type' => 'bar',
    ];

    $chart1 = new LaravelChart($chart_options);


   $chart_options2 = [
    'chart_title' => 'Auction by Week', 
    'report_type' => 'group_by_date',
    'model' => 'App\Auction',
    'group_by_field' => 'created_at',
    'group_by_period' => 'week',
    'chart_type' => 'bar',
    ];

    $chart2 = new LaravelChart($chart_options2);


   $chart_options3 = [
    'chart_title' => 'Auction Item by Week',
    'report_type' => 'group_by_date',
    'model' => 'App\AuctionItem',
    'group_by_field' => 'created_at',
    'group_by_period' => 'week',
    'chart_type' => 'bar',
    ];

    $chart3= new LaravelChart($chart_options3);


  $chart_options4 = [
    'chart_title' => ' News by Week',
    'report_type' => 'group_by_date',
    'model' => 'App\News',
    'group_by_field' => 'created_at',
    'group_by_period' => 'week',
    'chart_type' => 'bar',
    ];

    $chart4= new LaravelChart($chart_options4);



   $chart_options5 = [
    'chart_title' => 'Subscriber  by Week',
    'report_type' => 'group_by_date',
    'model' => 'App\Subscriber',
    'group_by_field' => 'created_at',
    'group_by_period' => 'week',
    'chart_type' => 'bar',
    ];
 
    $chart5= new LaravelChart($chart_options5);



  $chart_options6 = [
    'chart_title' => 'Contacts us Item by Week',
    'report_type' => 'group_by_date',
    'model' => 'App\Contacts',
    'group_by_field' => 'created_at',
    'group_by_period' => 'week',
    'chart_type' => 'bar',
    ];

    $chart6= new LaravelChart($chart_options6);

    $chart_options7 = [
    'chart_title' => 'Bidding by Week',
    'report_type' => 'group_by_date',
    'model' => 'App\Bidding',
    'group_by_field' => 'created_at',
    'group_by_period' => 'week',
    'chart_type' => 'bar',
    ]; 

    $chart7= new LaravelChart($chart_options7);


    $totalUsers=User::count();
   $totalAuction=Auction::count();  
   $totalAuctionItem=AuctionItem::count();
   $totalNews=News::count();  
   $totalSubscriber=Subscriber::count();  
   $totalContact=Contacts::count();  
   $totalBidding=Bidding::count();  
   $totalRole=Role::count();

    return view('admin.dashboard', compact('chart1','chart2','chart3','chart4','chart5','chart6','chart7','totalUsers','totalAuction','totalAuctionItem','totalNews','totalSubscriber','totalContact','totalBidding','totalRole'));


       
        
    }
} 
