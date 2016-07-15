<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        </style>
    </head>
    <body>
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center well">
              <!-- Button trigger modal -->
              <a name="pagination" type="button" class="btn btn-primary btn-lg" data-label="Simple Ajax Pagination" data-pagination="simple" data-toggle="modal" data-target="#myModal">
                Open Simple Ajax Pagination Modal
              </a>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">My Awesome Modal</h4>
              </div>
              <div class="modal-body">
                Loading ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" charset="utf-8"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script type="text/javascript">
          (function ($) {
            var nextUrl = '';
            var items = 1;
            var $modal;
            function loadData() {
              var options = {
                url: nextUrl || '{{ url('/users') }}',
                dataType: 'json'
              };

              $.ajax(options).success(function (res) {
                if (items == 1) {
                  $modal.find('.modal-body').html('<ul></ul><div class="text-center"><a type="button" class="btn btn-xs btn-primary" name="load-more" id="load-more">Load more</a></div>');
                }
                var result = res.data;
                var content = '';
                result.forEach(function (item) {
                  content += '<li>' + (items++) + '. ' + item.name + ' (' + item.email + ')</li>';
                });

                $(content).appendTo($modal.find('.modal-body > ul'));

                if (res.next_page_url) {
                  nextUrl = res.next_page_url;
                } else {
                  $('#load-more').remove();
                }
              });
            }

            $('#myModal').on('click', '#load-more', loadData);

            $('#myModal').on('show.bs.modal', function (e) {
              $modal = $(this);
              var $button = $(e.relatedTarget);
              var $pagination = $button.data('pagination');
              $modal.find('#myModalLabel').text($button.data('label'));
              loadData();
            });

            $('#myModal').on('hide.bs.modal', function () {
              $modal.find('.modal-body').html('');
              nextUrl = undefined;
              items = 1;
            });
          })(jQuery);
        </script>
    </body>
</html>
