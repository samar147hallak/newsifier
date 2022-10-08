@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Article</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                    <div class="col-sm-12" style="margin-bottom:20px">
                     <input type="text" placeholder="Article Header" class="form-control" id="article-header" >
                    </div>
                        <div class="col-sm-12">
                            
<div class="alert alert-success" id="success-alert" style="display:none;position: fixed; bottom: 1em; right: 2em;">
  <strong>Success!</strong>
   Article saved Successfully
</div>
<div class="alert alert-danger" id="danger-alert" style="display:none;position: fixed; bottom: 1em; right: 2em;">
  <strong>Error!</strong>
  Please insert article header and body
</div>
<div id="editorjs" style="max-width: 1000px; margin: 0 auto"></div>
<div id='searchModal'></div>
<div style="text-align:center">
<button style="width:40%" type="button" class="btn btn-default" id="save-button">Save</button>
</div>



<script>
  /**
   * Initialize the Editor
   */
  const editor = new EditorJS({
    placeholder: 'Let`s write an awesome story!',
    autofocus: true,
    tools: {
      gif: {
        class: SimpleImage,
        inlineToolbar: true,
        config: {
          openModal: (compId) => {

            var html = `
            <div id="${compId}" class="w3-modal w3-animate-opacity">
              <div class="w3-modal-content w3-card-4">
                <header class="w3-container" style='padding-top:10px'> 
                  <span onclick="document.getElementById('${compId}').style.display='none'" 
                  class="w3-button w3-large w3-display-topright">&times;</span>
                  <h4>Search Giff Images</h4>
                </header>
                <div class="w3-container" >
                
                  <div class="row" style="margin-bottom: 20px;">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="searchBox${compId}">
                    </div>
                    <div class="col-sm-2">
                      <button type="button" class="btn btn-default"  id="searchBtn${compId}">Search</button>
                    </div>
                  </div>
                  <hr/>
                  <div class="row" style="min-height: 20vh; max-height: 50vh; overflow-y: scroll;" id="giff-content${compId}">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-10">
                      <p>No results to show</p>
                    </div>
                  </div>
                  <div  class="row"  id="load-more-div${compId}">
                   
                  </div>
                    <hr/>

                </div>
                <footer class="w3-container ">
                  <div class="row" style="margin-bottom: 20px;">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-5">
                      <button style="width:90%" type="button" class="btn btn-default" onclick="document.getElementById('${compId}').style.display='none'" >Close</button>
                    </div>
                    <div class="col-sm-5">
                      <button style="width:90%" type="button" id='chooseBtn${compId}' class="btn btn-default" >Add</button>
                    </div>
                  </div>
                </footer>
              </div>
            </div>`;

            $("#searchModal").html(html);
            $(`#${compId}`).css('display', 'block');
          }
        }
      }
    }
  });

  /**
   * Add handler for the Save button
   */
  const saveButton = document.getElementById('save-button');

  saveButton.addEventListener('click', () => {
    editor.save().then(savedData => {
      if(!$('#article-header').val() || !savedData.blocks || savedData.blocks.length==0){
        $("#danger-alert").fadeTo(2000, 500).slideUp(500, function(){
                $("#danger-alert").slideUp(500);
          });
      }
      else{

          $.post("/postArticle",
          {
            "_token": "{{ csrf_token() }}",
            "header":$('#article-header').val(),
            "txt": JSON.stringify(savedData)
          },
          function(data, status){
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
                $("#success-alert").slideUp(500);
                window.location.href = "/admin";
            });
          });

       }
    })
  })
</script>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
