@extends("layouts.app")

@section('meta_title', $config->name . ' - ' . $departament->first_title ?? "")
@section('meta_keywords', $departament->meta_keywords ?? "")
@section('meta_description', $departament->meta_description ?? "")

@section('content')
    <div class="page-title">
        <span>{{ $departament->first_title }}</span>
    </div>
    <div class="info-page">
        <div class="description">{!! $departament->description !!}</div>
        <div class="workers">
            @foreach($workers as $emploee)
            <div class="employee">
                <img src="{{ $emploee->getPath() }}" alt="{{ $emploee->title ?? "" }}">
                <div class="employee-info">
                    <div class="name text-center">{{ $emploee->title ?? "" }}</div>
                    <div class="position">{{ $emploee->text ?? "" }}</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="page-title">
            <span>Зв'язок з нами</span>
        </div>
        <div class="connection">
            <div class="social-networks">
                <div class="net-head">
                    <a href="{{ $config->facebook ?? "" }}" target="_blank" rel="noreferrer" aria-label="Підтримуй зв'язок в facebook">
                        <img src="img/facebook.svg" alt="facebook">
                    </a>
                </div>
                <div class="net-description">
                    <span>
                        {{ $config->f_description ?? "" }}
                    </span>
                </div>
            </div>
            <div class="social-networks">
                <div class="net-head">
                    <a href="{{ $config->instagram ?? "" }}" target="_blank" rel="noreferrer" aria-label="Підтримуй зв'язок в instagram">
                        <img src="img/instagram-logo.png" alt="instagram">
                    </a>
                </div>
                <div class="net-description">
                    <span>
                        {{ $config->i_description ?? "" }}
                    </span>
                </div>
            </div>
            <div class="social-networks">
                <div class="net-head">
                <a href="{{ 'mailto:' . $config->email ?? "" }} "target="_blank" rel="noreferrer"
                    aria-label="Підтримуй зв'язок за допомогю email"
                    >
                    <img src="img/mail1.png" alt="email"></a>
                </div>
                <div class="net-description">
                    <span>
                        {{ $config->e_description ?? "" }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection