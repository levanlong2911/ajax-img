<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    
</head>
<body>
    <div class="container">
        <div class="row" style="margin-top:50px">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">Add new product</div>
                    <div class="card-body">
                        <form action="{{ route('product.save') }}" method="post" enctype="multipart/form-data" id="form">
                            @csrf
                            <div class="form-group">
                              <label for="product_name">Product name</label>
                              <input type="text" name="product_name" id="" class="form-control" placeholder="Product name">
                              <span class="text-danger error-text product_name_error"></span>
                            </div>
                            <div class="form-group">
                              <label for="product_img">Product img</label>
                              <input type="file" name="product_img" id="" class="form-control" placeholder="Product img">
                              <span class="text-danger error-text product_img_error"></span>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">All product</div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
    


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(function(){
            $('#form').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.code == 0){
                            $.each(data.error, function(prefix,val){
                                $(form).find('span.'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            $(form)[0].reset();
                            alert(data.msg);
                            // fetchAllProducts();
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>