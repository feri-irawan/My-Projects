const key = "AIzaSyCSlzzBll37d37Xai-B7gdmPCEgpbTixp4";
let   container = $("#hasil");

$("#input-search").on("keyup", function() {
  var keyword = $(this).val()
  
  container.html("<center>Loading...</center>")
  YTsearch(keyword)
});

$("#form-search").bind("submit", function() {
  var keyword = $("#input-search").val();
  
  container.html("<center>Loading...</center>")
  YTsearch(keyword)
});

function YTsearch(keyword) {
  $.ajax({
    url: "https://www.googleapis.com/youtube/v3/search",
    type: "get",
    data: {
      key: key,
      part: "snippet",
      q: keyword
    },
    success: (hasil) => {
      console.log("success")
      console.log(hasil)
      
      container.html("")
      
      $.each(hasil.items, (i, search) => {
        var videoId = search.id.videoId,
            kind = search.id.kind, 
            snippet = search.snippet,
            thumbnail = snippet.thumbnails.medium.url,
            title = snippet.title,
            description = snippet.description,
            publishedAt = snippet.publishedAt,
            channelTitle = snippet.channelTitle;
          
        if (kind == "youtube#channel") {
            thumbnail = `<img src="`+thumbnail+`" class="card-img-top">`;
        } else {
          thumbnail = `<iframe src="https://www.youtube.com/embed/`+videoId+`" class="card-img-top"></iframe>`;
        }
            
        container.append(`
        <div class="col-md-6">
          <div class="card mb-3">
            `+thumbnail+`
            <div class="card-body">
              <h5 class="card-title">`+title+`</h5>
              <span class="badge bg-primary">`+channelTitle+`</span>
              <span class="badge bg-light text-muted">`+dateFormat(publishedAt)+`</span>
            </div>
          </div>
        </div>
        `)
      })
    },
    error: (xhr, status, error) => {
      console.log(xhr.responseJSON.error.message)
    }
  })
}

// Date Format
function dateFormat(date) {
  var date = new Date(date);
  return ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear()
}