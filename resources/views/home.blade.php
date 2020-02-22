@extends('layouts.main')
@section('content')

@if(session('level')=='admin')
    <a href="{{route('user_page')}}">User</a>
    <a href="{{route('transportasi')}}">Transportasi</a>
    <a href="{{route('transportasi_tipe')}}">Tipe Transportasi</a>
    <a href="{{route('rute')}}">Rute</a>
@endif

<a href="{{route('jadwal')}}">Jadwal</a>
<a href="{{route('pemesanan')}}">Pemesanan</a>
<a href="{{route('flight')}}">flight</a>
<a href="{{route('train')}}">train</a>

@endsection
@push('js')
<script type="text/javascript">
var xhttp = new XMLHttpRequest();
var token = "<?= session('token') ?>";

function logout(){
    var url = "{{route('logot')}}";
    var data='?token='+token;

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            console.log(this.status,this.responseText)

            if (this.status == 401) {
                alert('Unauthorisez User');
            }

            if (this.status == 200) {
                alert('Logout Sukses')
                window.location.replace("{{ route('login') }}");
            }
        }
    }

    xhttp.open("GET", url+data, true);
    xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
    xhttp.send();
}

</script>
@endpush