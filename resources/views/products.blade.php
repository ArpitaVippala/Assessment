<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* Three equal columns */
            gap: 10px; /* Gap between grid items */
        }

        .grid-item {
            padding: 20px;
            border: 1px solid #ccc;
            text-align: center;
        }
    </style>
</head>
    <div class="container">
        <div class="container-fluid">
            <h1>Products</h1>
            <form id="productsForm">
                @csrf
                <div class="grid-container">
                    @if(!empty($products))
                        @foreach ($products as $product)
                            <div class="grid-item"><input type="checkbox" id="productId" name="productId[]" value="{{$product->id}}">{{$product->name}}</div>
                        @endforeach
                    @endif
                </div>
                <div>
                    <button type="submit" id="orderButt">Order</button>
                </div>
            </form>

            <div id="detailsDiv" style="display:none">
                <div style="">
                    <label>Email</label>
                    <input type="text" name="emailId" id="emailId" />
                </div>
                <div>
                    <label>Address</label>
                    <textarea type="text" id="ship_address" name="ship_address"></textarea>
                </div>
                    <button type="button" id="saveDet">Order</button>
            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    // $(document).ready(function(){
        // alert("hdbfsdhf");
        var products = new Array();
        $("#productsForm").submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type:"POST",
                url:"{{ route('saveOrder') }}",
                data:formData,
                success:function(data){
                    var response = JSON.parse(data);
                    console.log(response.data);
                    products = response.data;
                    if(response.res == '1'){
                        $("#detailsDiv").css('display', 'block');
                    }else{
                        $("#detailsDiv").css('display', 'none');
                    }
                }
            });
        });

        $("#saveDet").click(function(event){
            event.preventDefault();
            $email = $("#emailId").val();
            $ship_address = $("#ship_address").val();

            if($email == ""){
                return false;
            }

            if($ship_address == ""){
                return false;
            }
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"POST",
                url:"{{ route('saveDetails') }}",
                data:{
                    'email':$email,
                    'ship_address':$ship_address,
                    'products':products
                },
                success:function(data){
                    // console.log(data)
                    if(data == 0){
                        alert("You are not allowed to created order");
                    }
                    if(data == 1){
                        alert("Something went wrong. try again");
                    }
                    $("#emailId").val("");
                    $("#ship_address").val("");
                    $('#productsForm')[0].reset();
                }
            })
        })
        
    // })
</script>