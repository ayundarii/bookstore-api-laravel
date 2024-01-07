<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Books List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body class="bg-light">
    <main class="container">
       
        <div class="my-3 p-3 bg-body rounded shadow-sm">
                
                <div class="pb-3">
                  <form class="d-flex" action="/" method="post">
                    @csrf
                      <input class="form-control me-1" type="search" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Search Book Name..." aria-label="Search">
                      <select class="form-select me-1" name="listShow">
                        @for ($i = 10; $i <= 100; $i += 10)
                            <option value="{{ $i }}" {{ Request::get('listShow', 100) == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                      <button class="btn btn-secondary" type="submit">Search</button>
                  </form>
                </div>
          
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-3">Book Name</th>
                            <th class="col-md-3">Category Name</th>
                            <th class="col-md-3">Author</th>
                            <th class="col-md-3">Average Rating</th>
                            <th class="col-md-3">Voter</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $book)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $book['bookName'] }}</td>
                            <td>{{ $book['categoryName'] }}</td>
                            <td>{{ $book['authorName'] }}</td>
                            <td>{{ $book['averageRating'] }}</td>
                            <td>{{ $book['voters'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
               
          </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>
