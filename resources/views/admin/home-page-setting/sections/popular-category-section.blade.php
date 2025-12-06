 @php 

    $popularCategory = json_decode($popularcategory->value);

@endphp

<div class="tab-pane fade  show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
    <div class="card border">
       
        <div class="card-body">
            <form action="{{route('admin.update-popular-category')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12"> 
                    <h5>Category1</h5>
                    <div class="row">                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="cat_one" id="" class="form-control main-category">
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option {{$category->id == $popularCategory[0]->category ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Category</label>
                                @php
                                    $sub_categories = \App\Models\SubCategory::where('category_id', $popularCategory[0]->category)->get();
                                @endphp
                                <select name="sub_cat_one" id="" class="form-control  sub-category">
                                    <option value="">Select Category First</option>
                                    @foreach ($sub_categories as $subCategory)
                                        <option {{$subCategory->id == $popularCategory[0]->sub_category ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Child Category</label>
                                @php
                                    $child_categories = \App\Models\ChildCategory::where('sub_category_id', $popularCategory[0]->sub_category)->get();                                   
                                @endphp
                                <select name="child_cat_one" id="" class="form-control child-category">
                                    <option value="">Select Sub Category First</option>
                                    @foreach ($child_categories as $childCategory)
                                        <option {{$childCategory->id == $popularCategory[0]->child_category ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                    </div> 

                    <h5>Category2</h5>
                    <div class="row">                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="cat_two" id="" class="form-control main-category">
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option {{$category->id == $popularCategory[1]->category ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach                                  
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Category</label>
                                 @php
                                    $sub_categories = \App\Models\SubCategory::where('category_id', $popularCategory[1]->category)->get();
                                @endphp
                                <select name="sub_cat_two" id="" class="form-control  sub-category">
                                    <option value="">Select Category First</option>
                                    @foreach ($sub_categories as $subCategory)
                                        <option {{$subCategory->id == $popularCategory[1]->sub_category ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Child Category</label>
                                @php
                                    $child_categories = \App\Models\ChildCategory::where('sub_category_id', $popularCategory[1]->sub_category)->get();                                   
                                @endphp
                                <select name="child_cat_two" id="" class="form-control child-category">
                                    <option value="">Select Sub Category First</option>
                                    @foreach ($child_categories as $childCategory)
                                        <option {{$childCategory->id == $popularCategory[1]->child_category ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                    </div> 

                    <h5>Category3</h5>
                    <div class="row">                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="cat_three" id="" class="form-control main-category">
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option {{$category->id == $popularCategory[2]->category ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Category</label>
                                 @php
                                    $sub_categories = \App\Models\SubCategory::where('category_id', $popularCategory[2]->category)->get();
                                @endphp
                                <select name="sub_cat_three" id="" class="form-control  sub-category">
                                    <option value="">Select Category First</option>
                                    @foreach ($sub_categories as $subCategory)
                                        <option {{$subCategory->id == $popularCategory[2]->sub_category ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Child Category</label>
                                @php
                                    $child_categories = \App\Models\ChildCategory::where('sub_category_id', $popularCategory[2]->sub_category)->get();                                   
                                @endphp
                                <select name="child_cat_three" id="" class="form-control child-category">
                                    <option value="">Select Sub Category First</option>
                                    @foreach ($child_categories as $childCategory)
                                        <option {{$childCategory->id == $popularCategory[2]->child_category ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                    </div> 

                    <h5>Category4</h5>
                    <div class="row">                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="cat_four" id="" class="form-control main-category">
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option {{$category->id == $popularCategory[3]->category ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach                                     
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Category</label>
                                 @php
                                    $sub_categories = \App\Models\SubCategory::where('category_id', $popularCategory[3]->category)->get();
                                @endphp
                                <select name="sub_cat_four" id="" class="form-control  sub-category">
                                    <option value="">Select Category First</option>
                                    @foreach ($sub_categories as $subCategory)
                                        <option {{$subCategory->id == $popularCategory[3]->sub_category ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Child Category</label>
                                @php
                                    $child_categories = \App\Models\ChildCategory::where('sub_category_id', $popularCategory[3]->sub_category)->get();                                   
                                @endphp
                                <select name="child_cat_four" id="" class="form-control child-category">
                                    <option value="">Select Sub Category First</option>
                                    @foreach ($child_categories as $childCategory)
                                        <option {{$childCategory->id == $popularCategory[3]->child_category ? 'selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
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