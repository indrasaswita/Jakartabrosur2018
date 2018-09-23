@extends('layouts.container')
@section('content')
    <!-- <form> -->
<div ng-controller = "PaymentController" class="margin-top-80">
@if(isset($allsales))      
    @if ($allsales != null)
        @if (count($allsales) > 0)
    <div ng-init="initSales('{{json_encode($allsales)}}')"></div>
    <div ng-init="globalSalesID('{{$allsales['id']}}')"></div>
        @endif
    @endif
@endif
<!-- NANTI MESTI BUAT VALIDASI KALO ORANG LANGSUNG MASUK KE UPLOAD HARUS DI CEK DULU UDA ADA SESSION DARI PAGE ORDER BLOM.. -->
    @include('includes.nav.subnav')
    @include('includes.nav.salenav')    

    @if ($allsales != null)
        @if (count($allsales) > 0)

	<div class="row margin-0">
        <div class="col-md-offset-1 col-xs-9">
            <div class="alert alert-outline-lightmagenta">
                <h5 class="lightmagenta text-xs-center">
                    <span class="glyphicon glyphicon-collapse-down size-16"></span>
                     Transaksi Anda
                    <span class="pull-xs-right margin-0-10">
                        <a class="a-purple size-14" href="{{URL::asset('payment/invoice/pdf/'.$allsales['id'])}}">
                            <span class="glyphicon glyphicon-print size-12"></span> Print
                        </a>
                    </span>
                </h5>
                <table class="table table-sm table-bordered size-14 margin-0">
                    <thead class="text-center">
                        <tr class="bg-lightmagenta">
                            <th>No. Invoice</th>
                            <th>Tanggal Transaksi</th>
                            <th>Customer Name</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td>#[[zeroFill(allsales.id, 5)]]</td>
                            <td>[[allsales.created_at|date:'d MMM yyyy']]</td>
                            <td>[[allsales.customername]]</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="alert alert-outline-lightmagenta">
                <h5 class="lightmagenta text-xs-center">
                    <span class="glyphicon glyphicon-paperclip size-16"></span>
                     Detil Transaksi Anda
                </h5>
                <table class="table table-sm table-bordered size-14 margin-0">
                    <thead class="text-center">
                        <tr class="bg-lightmagenta">
                            <th class="width-min"><span class="glyphicon glyphicon-arrow-down"></span></th>
                            <th>Job</th>
                            <th>Detail</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in allsales.details">
                            <td class="text-xs-center">[[$index+1]].</td>
                            <td class="width-50">[[item.jobtitle]] <div class="tag tag-purple text-regular">[[item.jobtype]]</div></td>
                            <td class="text-center width-30">[[item.quantity|number:0]] [[item.quantitytypename]] [uk. [[item.imagesize]]]</td>
                            <td class="text-right">[[item.totalprice|number:0]]</td>
                        </tr>
                        <tr ng-show="allsales.delivery.length==1">
                            <td class="text-xs-center"><span class="glyphicon glyphicon-plane size-12"></span></td>
                            <td>Pengiriman</td>
                            <td class="text-xs-center">([[allsales.details.length]] items)</td>
                            <td class="text-right">[[allsales.delivery[0].price|number:0]]</td>
                        </tr>
                        <tr class="bg-lightmagenta">
                            <td class="text-right" colspan="3">Total Harga : </td>
                            <td class="text-right"><span class="pull-xs-left">Rp</span> [[totalprice|number:0]]</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div ng-hide="allsales.payment.length==1" class="alert alert-outline-lightmagenta text-xs-center padding-40">
                <h4 class="text-muted margin-0">Belum Ada Pembayaran</h4>
                <span class="size-14"><a class="a-purple" href="{{URL::asset('payment/confirm')}}/[[allsales.id]]"><span class="glyphicon glyphicon-check size-12"></span> Konfirmasi Pembayaran</a></span>
            </div>
            <div ng-show="allsales.payment.length==1" class="alert alert-outline-lightmagenta">
                <h5 class="lightmagenta text-xs-center">
                    <span class="glyphicon glyphicon-usd size-16"></span>
                     Pembayaran
                </h5>
                <table class="table table-sm table-bordered table-center size-14 margin-0">
                    <thead class="">
                        <tr class="bg-lightmagenta">
                            <th>Tanggal</th>
                            <th>Ammount</th>
                            <th>Catatan</th>
                            <th>Status Verif.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in allsales.payment">
                            <td>[[item.paydate|date:'dd MMM yyyy']]</td>
                            <td>Rp [[item.ammount|number:0]]</td>
                            <td>[[item.note]]</td>
                            <td><span class="glyphicon size-12" ng-class="{'glyphicon-ok green':item.verif!='no', 'glyphicon-remove red':item.verif=='no'}"></span> [[item.verif=='no'?'Belom di cek':'LUNAS']]</td>
                        </tr>
                        <!-- <tr>
                            <td class="text-xs-right bg-info" colspan="7">Total Harga : Rp [[totalprice|number:0]]</td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
            <div ng-hide="allsales.delivery.length==1" class="alert alert-outline-lightmagenta text-xs-center padding-40">
                <h4 class="text-muted margin-0">Detail Pengiriman Belum Diatur</h4>
                <span class="size-14"><a href="{{URL::asset('addresses')}}/[[allsales.id]]" class="a-purple"><span class="glyphicon glyphicon-map-marker"></span> Atur Alamat</a></span>
            </div>
            <div ng-show="allsales.delivery.length==1" class="alert alert-outline-lightmagenta">
                <h5 class="lightmagenta text-xs-center">
                    <span class="glyphicon glyphicon-plane size-16"></span>
                     Pengiriman
                </h5>
                <div ng-repeat="item in allsales.delivery">
                    <table class="table table-sm table-bordered size-14 margin-0">
                        <tbody>
                            <tr class="bg-lightmagenta text-center">
                                <th>Tanggal</th>
                                <th>Alamat Lengkap</th>
                                <th>Tipe</th>
                                <th>Biaya</th>
                            </tr>
                            <tr>
                                <td class="text-xs-center">[[allsales.estdate < bates? "Belum di set" : (allsales.estdate|date:'dd MMM yyyy')]]</td>
                                <td>[[item.address]]</td>
                                <td class="text-xs-center">[[item.deliverytype]]</td>
                                <td class="text-xs-right">[[item.price|number:0]]</td>
                            </tr>
                            <tr>
                                <td class="bg-lightmagenta text-xs-right">Penerima :</th>
                                <td colspan="3">[[item.receiver]]</td>
                            </tr>
                            <tr>
                                <td class="bg-lightmagenta text-xs-right">Catatan :</th>
                                <td colspan="3">[[item.customernote]]</td>
                            </tr>
                            <tr class="bg-lightmagenta text-center" ng-hide="item.arrivedtime<bates">
                                <th>Waktu Tiba</th>
                                <th>Nomor Surat Jalan</th>
                                <th>File</th>
                                <th>Waktu Input</th>
                            </tr>
                            <tr class="text-center" ng-hide="item.arrivedtime<bates">
                                <td>[[item.arrivedtime|date:'dd/MM/yy HH:mm']]</td>
                                <td>[[item.nodeliveryorder]]</td>
                                <td><span class="glyphicon glyphicon-cd"></span></td>
                                <td>[[item.updated_at|date:'dd/MM/yy']]</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="text-xs-center">
                <a class="btn btn-outline-purple size-14 btn-lg" href="{{URL::asset('payment/invoice/pdf/'.$allsales['id'])}}">
                    <span class="glyphicon glyphicon-print size-30"></span><br>
                    Lihat Invoice<br>dalam PDF
                </a>
                <a class="btn btn-outline-purple size-14 btn-lg" href="{{URL::asset('payment/confirm/'.$allsales['id'])}}" ng-show="allsales.payment[0].ammount==null">
                    <span class="glyphicon glyphicon-check size-30"></span><br>
                    Konfirmasi<br>Pembayaran
                </a>
            </div>
        </div>
            

        <div class="col-xs-3 padding-0">
            <div class="alert alert-outline-purple size-14 line-12 padding-20">
                <div class="row margin-0">
                    <div class="col-lg-12 text-center">
                        <img src="{{URL::asset('image/BCA.png')}}" width="100px" class="margin-10-0">
                        <div>Rek. Bank BCA</div>
                        <div>KCP. Pangeran Jayakarta</div>
                        <div class="text-bold">1-949-969-868</div>
                        <div>a/n. Indra Saswita</div>
                    </div>
                </div>
                <hr class="row margin-10-0">
                <div class="row margin-0">
                    <div class="col-lg-12 text-center">
                        <img src="{{URL::asset('image/MANDIRI.png')}}" width="100px" class="margin-10-0">
                        <div>Rek. Bank Mandiri</div>
                        <div>KCP. Pangeran Jayakarta</div>
                        <div class="text-bold">9-000-014-120-381</div>
                        <div>a/n. Indra Saswita</div>
                    </div>
                </div>
                <hr class="row margin-10-0">
                <div class="row margin-0">
                    <div class="col-lg-12 text-center">
                        <img src="{{URL::asset('image/BRI.png')}}" width="100px" class="margin-10-0">
                        <div>Rek. Bank BRI</div>
                        <div>KCP. Pangeran Jayakarta</div>
                        <div class="text-bold">NO ACC</div>
                        <div>a/n. Indra Saswita</div>
                    </div>
                </div>
                <hr class="row margin-10-0">
                <div class="row margin-0">
                    <div class="col-lg-12 text-center">
                        <img src="{{URL::asset('image/BNI.png')}}" width="100px" class="margin-10-0">
                        <div>Rek. Bank BNI 46</div>
                        <div>KCP. Pangeran Jayakarta</div>
                        <div class="text-bold">NO ACC</div>
                        <div>a/n. Indra Saswita</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @else
    <div class="text-muted margin-40-0 text-xs-center">
        <span class="size-30">Halaman Ini Error</span><br>
        <span class="size-16">Silahkan hubungi customer service kami.<br></span>
    </div>
        @endif
    @else
    <div class="text-muted margin-40-0 text-xs-center">
        <span class="size-30">Halaman Ini Error</span><br>
        <span class="size-16">Silahkan hubungi customer service kami.<br></span>
    </div>
    @endif
</div>
    <!-- </form> -->
@stop