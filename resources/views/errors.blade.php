@if ($errors->any())
    @foreach ($errors->all() as $error)
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="alert alert-danger">
              <ul>
                <li>
                  {{$error}}
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    @endforeach
@endif