@if(session('success'))<div class="admin-success">{{ session('success') }}</div>@endif
@if($errors->any())<div class="admin-errors"><strong>Please review the following:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
