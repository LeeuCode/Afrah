jQuery(function($) {


    // Treasury Bonds Ajax

    $('#bill-form').on('submit',function(e){
        e.preventDefault();
        return false; 
    });

    $('#item-name').on('keydown', function(){
        var itemName = $(this).val(),
            itemUrl = $(this).attr('data-url'),
            itemCode = $('#item-code');

        if(itemCode.val() == '') {

            if(itemName != "") {
                $.ajax({
                    url: itemUrl+'/'+itemName, 
                    method: 'GET',
                    beforeSend: function(){
                        $('.autocomplete').show();
                        $('#auto-ul').html('<li>جاري البحث ......</li>');
                    },
                    success:function(data, status){

                        if(itemName == ''){
                            $('.autocomplete').hide();
                        }

                        if(data == '') {
                            $('.autocomplete').show();
                            $('#auto-ul').html('<li>لا يوجد نتائج مطابقة</li>');
                        } else {

                            $('.autocomplete').show();
                            $('#auto-ul li').remove();

                            var x;
                            for(x in data) { 
                                $('#auto-ul').append('<li data-id="'+ data[x].barcode +'" class="select-item" >'+data[x].name+'</li>')
                            }
                        }
                    } 
                });
            } else {
                $('.autocomplete').show();
                $('#auto-ul li').remove(); 
            }
        }
     });

     $(document).on('click', '.select-item', function(){
        var itemId = $(this).data('id'),
            inputName = $(this).text(),
            itemCode = $('#item-code'),
            itemName = $('#item-name');

        itemCode.val(itemId);
        itemName.val(inputName);
        $('.autocomplete').show();
        $('#auto-ul li').remove();
        $('#store-name').focus();
     });

     $(window).on('click', function(){
        $('.autocomplete').hide();
     });

     var test = $('#auto-ul > li')
     $(document).on('keyup',function(e){
        if(e.which === 40){
            test.addClass('active');
        } 
    });

    $(document).on('change','#item-code',function(){

        var id = $(this).val(),
            itemUrl = $(this).attr('data-url'),
            itemName = $('#item-name'),
            storeName = $('#store-name'),
            itemId = $('#item-id');

        if (storeName.val() == '') {
            // alert('لم تقم بتحديد المخزن!');

            $.gritter.add({
                title: '<i class="fa fa-warning"></i> خطأ',
                text: 'لم تقم بأختيار المخزن!',
                class_name: 'gritter-error gritter-center'
            });

            storeName.focus();
            $(this).val('');
            itemName.val('');
        } else {
            // alert(itemUrl+'/'+id);

            $.get(itemUrl+'/'+id, function(data, status){
                if(data == '') {

                    $('#item-code').focus();
                    $('#item-code').val('');
                    itemName.val('');

                    $.gritter.add({
                        title: '<i class="fa fa-warning"></i> خطأ',
                        text: 'يبدو ان كود الصنف خطأ أو لا يوجد صنف مطابق!',
                        class_name: 'gritter-error gritter-center'
                    });
                    // alert('يبدو ان الصنف خطأ او لا يوجد صنف مطابق!');
                } else {
                    itemName.val(data.name);
                    itemId.val(data.id);

                    $('#quantity').attr('data-item-quantity', data.item_quantity);
                    $('#quantity').attr('data-item-minimum', data.minimum);

                    t();
                } 
            });
        }
    });

    $(document).on('change','#quantity', function(){
        var quantity = $(this).val(), 
            itemQuantity = $(this).attr('data-item-quantity');
            itemMinimum = $(this).attr('data-item-minimum');

        if(Number(quantity) >= Number(itemQuantity)) {
            // alert('يجب ان لا تزيد الكميه عن '+itemQuantity);

            $.gritter.add({
                title: '<i class="fa fa-warning"></i> خطأ',
                text: 'يجب ان لا تزيد الكميه عن '+itemQuantity,
                class_name: 'gritter-error gritter-center'
            });

            $(this).val('');
            $(this).focus();
        }
    });

    $(document).on('click', '.add-item', function() {
        var itemCode = $('#item-code'),
            itemId = $('#item-id'),
            itemName = $('#item-name'),
            storeName = $('#store-name'),
            selectText = storeName.children("option:selected").text(),
            quantity = $('#quantity'),
            quantityVal = Number(quantity.val()),
            itemQuantity =  Number($('#quantity').attr('data-item-quantity')),
            quantities = (itemQuantity - quantityVal) , 
            date = $('#date');

        if(storeName.find('option:selected').attr('value') == '') {
            // alert('اختار مخزن ليتم اضافة الفاتوره له');
            $.gritter.add({
                title: '<i class="fa fa-warning"></i> خطأ',
                text: 'اختار مخزن ليتم اضافة الفاتوره له',
                class_name: 'gritter-error gritter-center'
            });

            // storeName.focus();
        }else if(itemCode.val() == '') {
            // alert('من فضلك أدخل باركود صحيح');
            $.gritter.add({
                title: '<i class="fa fa-warning"></i> خطأ',
                text: 'من فضلك أدخل باركود صحيح',
                class_name: 'gritter-error gritter-center'
            });

            resetVal();
        }else if(itemName.val() == '') {
            // alert('من فضلك قم بادخال اسم صنف صحيح');
            $.gritter.add({
                title: '<i class="fa fa-warning"></i> خطأ',
                text: 'من فضلك قم بادخال اسم صنف صحيح!',
                class_name: 'gritter-error gritter-center'
            });

            resetVal();
        }else if(quantity.val() == '') {
            // alert('من فضلك قم بادخال كمية مناسبه');
            $.gritter.add({
                title: '<i class="fa fa-warning"></i> خطأ',
                text: 'من فضلك قم بادخال كمية مناسبه !',
                class_name: 'gritter-error gritter-center'
            });
            resetVal();
        }else if(Number.isNaN(quantityVal)) {
            // alert('يجب أن تكون الكمية ارقام فقط');
            $.gritter.add({
                title: '<i class="fa fa-warning"></i> خطأ',
                text: 'يجب أن تكون الكمية ارقام فقط!',
                class_name: 'gritter-error gritter-center'
            });
        } else {

            var equal = false;

            $('.item-container-tb tr').each(function(){
                var id = $(this).attr('id'),
                quantityTd = $(this).find('td p').eq(2);
                quantityTotal = Number(quantityVal) + Number(quantityTd.text()) ,
                tdQuantities = quantityTd.prev('input').attr('data-quantities');

                if(Number(id) == Number(itemCode.val())) {

                    if(quantities < quantity.val()) {
                        // alert('المتاح بالمخزن '+tdQuantities+' فقط لا غير');
                        $.gritter.add({
                            title: '<i class="fa fa-warning"></i> خطأ',
                            text: 'المتاح بالمخزن '+tdQuantities+' فقط لا غير',
                            class_name: 'gritter-error gritter-center'
                        });
                    } else {
                        quantityTd.text(quantityTotal);
                        quantityTd.prev('input').val(quantityTotal);
                        
                        quantityTd.prev('input').attr('data-quantities', quantities);
                    }

                    resetVal();
                    equal =  true;
                }
            });

            if(equal == false) {
                $('.item-container-tb').append(
                    '<tr id="'+ itemCode.val() +'">'+
                        '<td>'+
                        '<input type="hidden" class="form-control" name="barcode[]" value="'+ itemCode.val() +'" >'+
                        '<input type="hidden" name="item_id[]" value="'+ itemId.val() +'" >'+
                        '<p>'+ itemCode.val() +'</p>'+
                        '</td>'+
                        
                        '<td>'+
                            '<input type="hidden" class="form-control"  name="name[]" value="'+ itemName.val() +'" >'+
                            '<p>'+ itemName.val() +'</p>'+
                        '</td>'+
                        '<td>'+
                            '<input data-quantities="'+ quantities +'" type="hidden" class="form-control quantity-input"  name="quantity[]" value="'+ quantity.val() +'" >'+
                            '<p class="quantity">'+ quantity.val() +'</p>'+
                        '</td>'+
                        '<td>'+
                            '<button class="btn btn-danger btn-xs remove-item" type="button">'+
                                '<i class="fa fa-trash-o" ></i>'+
                            '</button>'+
                        '</td>'+
                    '</tr>');

                resetVal();
            }
        }

        function resetVal() {
            itemCode.val('');
            itemName.val('');
            quantity.val('');
            itemCode.focus();
        }
    });

    /* remove item row from bill table */
    $(document).on('click', '.remove-item', function() {
        $(this).parent().parent().remove();
    });

    /* dblclick to edit quantity */
    $(document).on('dblclick', '.quantity', function(){
        $(this).prev('input').attr('type','text');
        $(this).hide();
    });

    /* blur to change quantity p text and hidden input type */
    $(document).on('blur', '.quantity-input', function() {
        var input = $(this),
            quantity = $(this).nextAll('p');
        input.attr('type','hidden');
        quantity.text(input.val());
        quantity.show();
    });

    $(document).on('change', '#store-name', function(){
        var storeId = $('#store-id'),
            storeName = $(this),
            storeOption = storeName.find('option:selected').attr('value') ;

        $('#item-code').focus();
        storeId.val(storeOption);
    });

    /* add-bill to add bill to database by ajax */
    $(document).on('click', '.add-bill', function() {
        var billForm = $('#bill-form'),
            data = billForm.serialize(),
            url = billForm.attr('action'),
            method = billForm.attr('method');

        if($('.item-container-tb tr').length > 0 ){
            $.ajax({
                type:method,
                cache:false,
                url:url,
                data:data, // multiple data sent using ajax
                success: function (data) {
                    $('.item-container-tb tr').remove();
                    $('#item-code').focus();
                    $('#store-name').find('option').eq(0).attr('selected');

                    $('#bill-id').text('0'+data.id);
                    $('#reception_id').val(data.id);
                    alert(data.message);
                }
            });
        }else {
            alert('لم تقم بأضافة اي صنف في الفاتوره, قم بأضافة الاصناف ثم قم بحفظ الفاتوره!')
        }
    });


    function t() 
    {
        var itemCode = $('#item-code'),
            itemId = $('#item-id'),
            itemName = $('#item-name'),
            storeName = $('#store-name'),
            selectText = storeName.children("option:selected").text(),
            quantity = $('#quantity'),
            quantityVal = Number(quantity.val()),
            itemQuantity =  Number($('#quantity').attr('data-item-quantity')),
            quantities = (itemQuantity - quantityVal) , 
            date = $('#date');

        $('.item-container-tb tr').each(function(){
            var id = $(this).attr('id'),
            quantityTd = $(this).find('td p').eq(2);
            quantityTotal = Number(quantityVal) + Number(quantityTd.text()) ,
            tdQuantities = quantityTd.prev('input').attr('data-quantities');

            if(Number(id) == Number(itemCode.val())) {

                // if(quantities < quantity.val()) {
                //     alert('المتاح بالمخزن '+tdQuantities+' فقط لا غير');
                // } else {
                //     quantityTd.text(quantityTotal);
                //     quantityTd.prev('input').val(quantityTotal);
                // }

                $('#quantity').attr('data-item-quantity', tdQuantities);
                console.log('تم بنجاح تشغيل الداله'+tdQuantities);


                // resetVal();
                // equal =  true;
            }
        });

        
    }


    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });

    // if(!ace.vars['touch']) {
    //     $('.chosen-select').chosen({allow_single_deselect:true}); 
    // }

//     $('.easy-pie-chart.percentage').each(function(){
//         var $box = $(this).closest('.infobox');
//         var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
//         var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
//         var size = parseInt($(this).data('size')) || 50;
//         $(this).easyPieChart({
//             barColor: barColor,
//             trackColor: trackColor,
//             scaleColor: false,
//             lineCap: 'butt',
//             lineWidth: parseInt(size/10),
//             animate: ace.vars['old_ie'] ? false : 1000,
//             size: size
//         });
//     })

//     $('.sparkline').each(function(){
//         var $box = $(this).closest('.infobox');
//         var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
//         $(this).sparkline('html',
//         {
//             tagValuesAttribute:'data-values',
//             type: 'bar',
//             barColor: barColor ,
//             chartRangeMin:$(this).data('min') || 0
//         });
//     });


//     //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
//     //but sometimes it brings up errors with normal resize event handlers
//     $.resize.throttleWindow = false;

//     var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
//     var data = [
//     { label: "social networks",  data: 38.7, color: "#68BC31"},
//     { label: "search engines",  data: 24.5, color: "#2091CF"},
//     { label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
//     { label: "direct traffic",  data: 18.6, color: "#DA5430"},
//     { label: "other",  data: 10, color: "#FEE074"}
//     ]
//     function drawPieChart(placeholder, data, position) {
//         $.plot(placeholder, data, {
//         series: {
//             pie: {
//                 show: true,
//                 tilt:0.8,
//                 highlight: {
//                     opacity: 0.25
//                 },
//                 stroke: {
//                     color: '#fff',
//                     width: 2
//                 },
//                 startAngle: 2
//             }
//         },
//         legend: {
//             show: true,
//             position: position || "ne", 
//             labelBoxBorderColor: null,
//             margin:[-30,15]
//         }
//         ,
//         grid: {
//             hoverable: true,
//             clickable: true
//         }
//         })
//     }
//     drawPieChart(placeholder, data);

//     /**
//  we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
//     so that's not needed actually.
//     */
//     placeholder.data('chart', data);
//     placeholder.data('draw', drawPieChart);


//     //pie chart tooltip example
//     var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
//     var previousPoint = null;

//     placeholder.on('plothover', function (event, pos, item) {
//     if(item) {
//         if (previousPoint != item.seriesIndex) {
//             previousPoint = item.seriesIndex;
//             var tip = item.series['label'] + " : " + item.series['percent']+'%';
//             $tooltip.show().children(0).text(tip);
//         }
//         $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
//     } else {
//         $tooltip.hide();
//         previousPoint = null;
//     }
    
//     });

//     /////////////////////////////////////
//     $(document).one('ajaxloadstart.page', function(e) {
//         $tooltip.remove();
//     });




//     var d1 = [];
//     for (var i = 0; i < Math.PI * 2; i += 0.5) {
//         d1.push([i, Math.sin(i)]);
//     }

//     var d2 = [];
//     for (var i = 0; i < Math.PI * 2; i += 0.5) {
//         d2.push([i, Math.cos(i)]);
//     }

//     var d3 = [];
//     for (var i = 0; i < Math.PI * 2; i += 0.2) {
//         d3.push([i, Math.tan(i)]);
//     }
    

//     var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
//     $.plot("#sales-charts", [
//         { label: "Domains", data: d1 },
//         { label: "Hosting", data: d2 },
//         { label: "Services", data: d3 }
//     ], {
//         hoverable: true,
//         shadowSize: 0,
//         series: {
//             lines: { show: true },
//             points: { show: true }
//         },
//         xaxis: {
//             tickLength: 0
//         },
//         yaxis: {
//             ticks: 10,
//             min: -2,
//             max: 2,
//             tickDecimals: 3
//         },
//         grid: {
//             backgroundColor: { colors: [ "#fff", "#fff" ] },
//             borderWidth: 1,
//             borderColor:'#555'
//         }
//     });


    $('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
    function tooltip_placement(context, source) {
        var $source = $(source);
        var $parent = $source.closest('.tab-content')
        var off1 = $parent.offset();
        var w1 = $parent.width();

        var off2 = $source.offset();
        //var w2 = $source.width();

        if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
        return 'left';
    }


    $('.dialogs,.comments').ace_scroll({
        size: 300
    });
    
    
    //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
    //so disable dragging when clicking on label
    var agent = navigator.userAgent.toLowerCase();
    if(ace.vars['touch'] && ace.vars['android']) {
        $('#tasks').on('touchstart', function(e){
        var li = $(e.target).closest('#tasks li');
        if(li.length == 0)return;
        var label = li.find('label.inline').get(0);
        if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
        });
    }

    $('#tasks').sortable({
        opacity:0.8,
        revert:true,
        forceHelperSize:true,
        placeholder: 'draggable-placeholder',
        forcePlaceholderSize:true,
        tolerance:'pointer',
        stop: function( event, ui ) {
            //just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
            $(ui.item).css('z-index', 'auto');
        }
        }
    );
    $('#tasks').disableSelection();
    $('#tasks input:checkbox').removeAttr('checked').on('click', function(){
        if(this.checked) $(this).closest('li').addClass('selected');
        else $(this).closest('li').removeClass('selected');
    });


    //show the dropdowns on top or bottom depending on window height and menu position
    $('#task-tab .dropdown-hover').on('mouseenter', function(e) {
        var offset = $(this).offset();

        var $w = $(window)
        if (offset.top > $w.scrollTop() + $w.innerHeight() - 100) 
            $(this).addClass('dropup');
        else $(this).removeClass('dropup');
    });
});