@extends('layouts.app')

@section('content')
<div class="row vh-100 overflow-auto">

    @include('components.navbar')

    <div class="col d-flex flex-column h-sm-100 py-4">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-xl-6">
                    <div class="card bg-light py-2 px-2 mb-4">
                        @if ($category->id == 1)
                            <h1 class="display-8 text-danger">{{$category->name}}</h1>
                        @else
                            <h1 class="display-8 text-warning">{{$category->name}}</h1>
                        @endif
                        <div class="card-body">
                            @if ($category->getActiveRelatedNews()->count() > 0)
                                @foreach ($category->getActiveRelatedNews() as $news)
                                    <h1 class="text-white fs-3">{{$news->title}}</h1>
                                    <div class="text-white-50 fs-7 mb-2">
                                        von: {{$news->creator->name ?? 'gelöschter Nutzer'}}, {{$news->readableStartedAt()}}
                                    </div>
                                    <div class="text-white fs-5">
                                        {!!nl2br(e($news->content))!!}
                                    </div>
                                    <hr/>
                                @endforeach
                            @else
                                <div class="alert alert-info">
                                    Es gibt zurzeit keine Neuigkeiten für diesen Bereich.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
