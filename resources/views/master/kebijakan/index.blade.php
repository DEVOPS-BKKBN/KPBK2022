@extends('layouts.app', [
    'title' => __('Role Management'),
    'parentSection' => 'master',
    'elementName' => 'provinsi'
])

@section('content')
    @component('layouts.headers.auth') 
        @component('layouts.headers.breadcrumbs')
            @slot('title') 
                {{ __('Bidang kebijakan') }} 
            @endslot

            <li class="breadcrumb-item"><a href="{{ route('kebijakan.index') }}">{{ __('Master Bidang Kebijakan') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('List') }}</li>
        @endcomponent
    @endcomponent

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('kebijakan') }}</h3>
                                <p class="text-sm mb-0">
                                    {{ __('This is an example of bidang kebijakan management. This is a minimal setup in order to get started fast.') }}
                                </p>
                            </div>
                            @can('create', App\Role::class)
                                <div class="col-4 text-right">
                                    <a href="{{ route('kebijakan.create') }}" class="btn btn-sm btn-primary">{{ __('Add kebijakan') }}</a>
                                </div>
                            @endcan
                        </div>
                    </div>
                    
                    <div class="col-12 mt-2">
                        @include('alerts.success')
                        @include('alerts.errors')
                    </div>

                    <div class="table-responsive py-4">
                        <table class="table table-flush"  id="datatable-basic">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Id') }}</th>
                                    <th scope="col">{{ __('Nama') }}</th>
                                    <th scope="col">{{ __('Desc') }}</th>
                                    @can('manage-items', App\User::class)
                                        <th scope="col">{{ __('Action') }}</th>
                                    @endcan
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kebijakans as $kebijakan)
                                    <tr>
                                        <td>{{ $kebijakan->id }}</td>
                                        <td>{{ $kebijakan->name }}</td>
                                        <td>{{ $kebijakan->description }}</td>
                                        @can('manage-items', App\User::class)
                                            <td class="text-right">
                                                {{ $kebijakan->item }}
                                                @if (auth()->user()->can('update', $kebijakan) || auth()->user()->can('delete', $kebijakan))
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            @can('update', $kebijakan)
                                                                <a class="dropdown-item" href="{{ route('kebijakan.edit', $kebijakan) }}">{{ __('Edit') }}</a>
                                                            @endcan
                                                            @if ($kebijakan->transaksi->isEmpty() && auth()->user()->can('delete', $kebijakan))
                                                                <form action="{{ route('kebijakan.destroy', $kebijakan) }}" method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this kebijakan?") }}') ? this.parentElement.submit() : ''">
                                                                        {{ __('Delete') }}
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
@endpush

@push('js')
    <script src="{{ asset('argon') }}/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
@endpush