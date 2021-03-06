@extends('layouts.app')
@section('content')
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
<div class="sidebar-scroll">
    <aside id="aside-menu">
        @include('mealplan.showsidemenu')
    </aside>
</div>
<div id="wrapper">
    <!-- <div id="pdfwrapper"> -->
        <div class="row m-b">
            <div class="col-lg-12 pull-right">
                <a href="#" id="downloadBtn" class="btn btn-primary pull-right" type="" name="" value="">
                    <i class="fas fa-file-download"></i>
                    ดาวน์โหลดรายงาน
                </a>
            </div>
        </div>
        <div id="meal-plan">
        </div>
    <!-- </div> -->
</div>

@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="{{ asset('js/getfoodlogs.js') }}"></script>
    <script type="application/javascript">
        // console.log("before js");
        // $('#downloadBtn').click(downloadReport_jspdf);
        $('#downloadBtn').click(generateDomPdf);
        function generateDomPdf(){
            var data = gatherData();
            console.log(data);
            $.ajax({
                type: "POST",
                url: "/report/pdf",
                data: data,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response) {
                    console.log("success");
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "Sample.pdf";
                    link.click();
                }
            });
        }

        function gatherData(){
            var reports = [];
            var start = startDate.toLocaleDateString('th-TH', {
                                year: '2-digit',
                                month: 'short',
                                day: 'numeric',
                            });
            var end = endDate.toLocaleDateString('th-TH', {
                                year: '2-digit',
                                month: 'short',
                                day: 'numeric',
                            });

            $.each($('.report-nutrition'), function(){
                var myReport = $(this);
                var energyBar = myReport.find('.col-nutrition>.energy').first().find('.selected').first().data("grade");
                var proteinBar = myReport.find('.col-nutrition>.protein').first().find('.selected').first().data("grade");
                var fatBar = myReport.find('.col-nutrition>.fat').first().find('.selected').first().data("grade");
                var carbBar = myReport.find('.col-nutrition>.carbohydrate').first().find('.selected').first().data("grade");
                var report = {
                    'id': myReport.attr('id'),
                    'age-range-span' : myReport.find('.age-range-span').first().text(),
                    'food-type-span': myReport.find('#food-type-span').text(),
                    'nutrition-span-protein': myReport.find('.nutrition-span.protein').first().text(),
                    'nutrition-span-fat': myReport.find('.nutrition-span.fat').first().text(),
                    'nutrition-span-carbohydrate': myReport.find('.nutrition-span.carbohydrate').first().text(),
                    'energy-selected': energyBar ? energyBar : 'none',
                    'protein-selected': proteinBar ? proteinBar : 'none',
                    'fat-selected': fatBar ? fatBar : 'none',
                    'carbohydrate-selected': carbBar ? carbBar : 'none',
                }
                reports.push(report);
            });
            var data = {
                startDate: startDate.toLocaleDateString(),
                endDate: endDate.toLocaleDateString(), 
                foodType: reports[0]['id'],
                reports: reports,
            }
            return data;
        }

        function downloadReport(){
            $.ajax({
                type: "POST",
                url: "/downloadreport",
                data: {
                    date: {
                        startDate: startDate.toLocaleDateString(),
                        endDate: endDate.toLocaleDateString(), 
                    }, 
                    foodType: foodType,
                },
                xhrFields: {
                    responseType: 'blob' // to avoid binary data being mangled on charset conversion
                },
                success: function(data) {
                    console.log("success");
                }
            });
        }

        function downloadReport_jspdf(){
            // $('#downloadBtn').hide();
            var report = $('.report-nutrition')[0];
            // console.log("pdf", pdf);
            // domtoimage.toPng(report, {
            //      width: $(report).width(), 
            //      height: $(report).height(),
            //      style:{background: 'white'},
            // }).then(function (blob) {
            //     //window.saveAs(blob, 'my-node.png');
            //     var pdf = new jsPDF('p', 'mm', "a4");
            //     // var width = pdf.internal.pageSize.getWidth();
            //     // var height = pdf.internal.pageSize.getHeight();

            //     pdf.addImage(blob, 'PNG', 0, 0, 190, 287);
            //     pdf.save("test.pdf");

            //     // that.options.api.optionsChanged();
            //     // $('#downloadBtn').show();
            // });


            var doc = new jsPDF();
            var specialElementHandlers = {
                '#editor': function (element, renderer) {
                    return true;
                }
            };

              
            doc.fromHTML($(report).html(), 15, 15, {
                'width': 170,
                    'elementHandlers': specialElementHandlers
            });
            doc.save('sample-file.pdf');
            
         }

    </script>
@endsection

