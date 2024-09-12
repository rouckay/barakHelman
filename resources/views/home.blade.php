<x-app-layout>
    <div class="card h-100">
        <div class="py-2 card-header bg-light">
            <div class="row flex-between-center">
                <div class="col-auto">
                    <h6 class="mb-0">ټولی ځمکی</h6>
                </div>
                <div class="col-auto d-flex"><a class="btn btn-link btn-sm me-2" href="#!">اضافه معلومات</a>
                    <div class="dropdown font-sans-serif btn-reveal-trigger"><button
                            class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal"
                            type="button" id="dropdown-top-products" data-bs-toggle="dropdown" data-boundary="viewport"
                            aria-haspopup="true" aria-expanded="false"><span
                                class="fas fa-ellipsis-h fs--2"></span></button>
                        <div class="py-2 border dropdown-menu dropdown-menu-end"
                            aria-labelledby="dropdown-top-products"><a class="dropdown-item" href="#!">لیدل</a><a
                                class="dropdown-item" href="#!">استخراج کول</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">حذف
                                کول</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body h-100">
            <div id="tableExample3" data-list='{"valueNames":["name","email","age"],"page":5,"pagination":true}'>
                <div class="row justify-content-end g-0">
                    <div class="col-auto mb-3 col-sm-5">
                        <form>
                            <div class="input-group"><input class="shadow-none form-control form-control-sm search"
                                    type="search" placeholder="Search..." aria-label="search" />
                                <div class="bg-transparent input-group-text"><span
                                        class="fa fa-search fs--1 text-600"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive scrollbar">
                    <table class="table mb-0 table-bordered table-striped fs--1">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th class="sort" data-sort="name">د نمری (ځمکی) نمبر</th>
                                <th class="sort" data-sort="name">د نمری (ځمکی) قیمت</th>
                                <th class="sort" data-sort="name">د تعرفی قیمت</th>
                                <th class="sort" data-sort="tarif">دنلود تعرفه</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($Numeraha as $Numeraha)
                                <tr>
                                    <td class="name">{{$Numeraha->numera_id}}</td>
                                    <td class="Position">{{ $Numeraha->numera_type}}</td>
                                    <td class="">{{ $Numeraha->sharwali_tarifa_price }}</td>
                                    <td>
                                        @foreach($Numeraha->Customers as $customer)
                                            {{ $customer->name }}<br>
                                        @endforeach
                                    </td>
                                    <td class="">{{ $Numeraha->save_number }}</td>

                                    <td class=""><i class="fa fa-download"></i></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 d-flex justify-content-center"><button class="btn btn-sm btn-falcon-default me-1"
                        type="button" title="Previous" data-list-pagination="prev"><span
                            class="fas fa-chevron-left"></span></button>
                    <ul class="mb-0 pagination"></ul><button class="btn btn-sm btn-falcon-default ms-1" type="button"
                        title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"> </span></button>
                </div>
            </div>
            <!-- <app-transaction></app-transaction> -->
</x-app-layout>
