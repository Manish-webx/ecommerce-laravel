@php
    
    $popularCategorySectionOne = json_decode($popularCategorySectionOne->value);    
@endphp


<div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
    <div class="card border">       
        <div class="card-body">
            <form action="{{route('admin.update-popular-slider-one')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12"> 
                    <div class="row">                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="cat_one" id="" class="form-control main-category">
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option {{$category->id == $popularCategorySectionOne->category ? 'selected' : ''}}  value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Category</label>  
                                @php
                                    $sub_categories = \App\Models\SubCategory::where('category_id', $popularCategorySectionOne->category)->get();
                                @endphp                              
                                <select name="sub_cat_one" id="" class="form-control  sub-category">
                                    <option value="">Select Category</option>
                                    @foreach ($sub_categories as $subCategory)
                                        <option {{$subCategory->id == $popularCategorySectionOne->sub_category ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                    @endforeach                                
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Child Category</label>  
                                @php
                                    $child_categories = \App\Models\ChildCategory::where('sub_category_id', $popularCategorySectionOne->sub_category)->get();                                   
                                @endphp                              
                                <select name="child_cat_one" id="" class="form-control child-category">
                                    <option value="">Select Subcategory</option>
                                    @foreach ($child_categories as $childCategory)
                                        <option {{$childCategory->id == $popularCategorySectionOne->child_category ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                    @endforeach                                   
                                </select>
                            </div>
                        </div>
                    </div> 
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')

<script>

    $(document).ready(function(){

      $('body').on('change', '.main-category', function(){
          let id = $(this).val()
          let row = $(this).closest('.row')
          $.ajax({

            url:"{{route('admin.get-subcategories')}}",
            method:'GET',
            data:{
                id: id
            },
            success: function(data){
                let selector = row.find('.sub-category')
                selector.html('<option value="">Select</option>')
                $.each(data, function(i, item){
                    selector.append(`<option value="${item.id}">${item.name}</option>`)
                })
            },
            error:function(xhr, status, error){
                console.log(error)
            }             

          })         

      })


      $('body').on('change', '.sub-category', function(){
          let id = $(this).val()
          let row = $(this).closest('.row')
          $.ajax({

            url:"{{route('admin.getproduct-childcategories')}}",
            method:'GET',
            data:{
                id: id
            },
            success: function(data){
                let selector = row.find('.child-category')
                selector.html('<option value="">Select</option>')
                $.each(data, function(i, item){
                    selector.append(`<option value="${item.id}">${item.name}</option>`)
                })
            },
            error:function(xhr, status, error){
                console.log(error)
            }             

          })         

      })

    })

</script>

  
@endpush