<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\{Inquiry,Memory,Reason,TimelineEntry}; use Illuminate\Support\Facades\DB;
class AdminDashboardController extends Controller { public function __invoke(){return view('admin.dashboard', ['newInquiries'=>Inquiry::where('status','new')->count(),'totalInquiries'=>Inquiry::count(),'memories'=>Memory::count(),'reasons'=>Reason::count(),'timeline'=>TimelineEntry::count(),'recentInquiries'=>Inquiry::latest()->limit(5)->get()]);} }
