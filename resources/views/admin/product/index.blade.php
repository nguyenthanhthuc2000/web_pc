@extends('admin.layout.content')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12 mt-5">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h4 class="card-title float-left mt-2">Đơn hàng</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-center">
                                    <thead>
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>Name</th>
                                        <th>Email ID</th>
                                        <th>Aadhar Number</th>
                                        <th class="text-center">Room Type</th>
                                        <th class="text-right">Number</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-nowrap">
                                            <div>BKG-0001</div>
                                        </td>
                                        <td class="text-nowrap">Tommy Bernal</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="3743585a5a4e55524559565b77524f565a475b521954585a">[email&#160;protected]</a></td>
                                        <td>12414786454545</td>
                                        <td class="text-center">Double</td>
                                        <td class="text-right">
                                            <div>631-254-6480</div>
                                        </td>
                                        <td class="text-center"> <span class="badge badge-pill bg-success inv-badge">INACTIVE</span> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <div>BKG-0002</div>
                                        </td>
                                        <td class="text-nowrap">Ellen Thill</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="89fbe0eae1e8fbedebfbe6ebfafdc9ecf1e8e4f9e5eca7eae6e4">[email&#160;protected]</a></td>
                                        <td>5456223232322</td>
                                        <td class="text-center">Double</td>
                                        <td class="text-right">
                                            <div>830-468-1042</div>
                                        </td>
                                        <td class="text-center"> <span class="badge badge-pill bg-success inv-badge">INACTIVE</span> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <div>BKG-0003</div>
                                        </td>
                                        <td class="text-nowrap">Corina Kelsey</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="76131a1a1318021e1f1a1a36130e171b061a135815191b">[email&#160;protected]</a></td>
                                        <td>454543232625</td>
                                        <td class="text-center">Single</td>
                                        <td class="text-right">
                                            <div>508-335-5531</div>
                                        </td>
                                        <td class="text-center"> <span class="badge badge-pill bg-success inv-badge">INACTIVE</span> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <div>BKG-0004</div>
                                        </td>
                                        <td class="text-nowrap">Carolyn Lane</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="50333f22393e313b353c23352910373d31393c7e333f3d">[email&#160;protected]</a></td>
                                        <td>2368989562621</td>
                                        <td class="text-center">Double</td>
                                        <td class="text-right">
                                            <div>262-260-1170</div>
                                        </td>
                                        <td class="text-center"> <span class="badge badge-pill bg-success inv-badge">INACTIVE</span> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">
                                            <div>BKG-0005</div>
                                        </td>
                                        <td class="text-nowrap">Denise</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="1c7f7d6e73706572707d72795c7b717d7570327f7371">[email&#160;protected]</a></td>
                                        <td>3245455582287</td>
                                        <td class="text-center">Single</td>
                                        <td class="text-right">
                                            <div>570-458-0070</div>
                                        </td>
                                        <td class="text-center"> <span class="badge badge-pill bg-success inv-badge">INACTIVE</span> </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

