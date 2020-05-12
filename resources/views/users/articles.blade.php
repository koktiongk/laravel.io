@title('My Articles')

@extends('layouts.default')

@section('subnav')
    <div class="bg-white border-b pt-8">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-xl py-4 text-gray-900">
                {{ $title }}
            </h1>
            <div class="flex">
                <a href="{{ route('series.create') }}" class="button mr-2">
                    Create Series
                </a>
                <a href="{{ route('articles.create') }}" class="button button-primary">
                    Create Article
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container mx-auto px-4 pt-8 flex flex-wrap flex-col-reverse lg:flex-row">
        <div class="w-full">
            @foreach($articles as $article)
                <div class="pb-8 mb-8 border-b-2">
                    <div>
                        @if($article->isNotPublished())
                            <span class="label mr-2">
                                Draft
                            </span>
                        @endif
                        @foreach($article->tags() as $tag)
                            <span class="rounded-full bg-green-light text-green-primary inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium leading-5">
                                {{ $tag->name() }}
                            </span>
                        @endforeach
                    </div>
                    <a href="{{ route('articles.show', $article->slug()) }}" class="block">
                        <div class="mt-4 flex justify-between items-center">
                            <h3 class="text-xl leading-7 font-semibold text-gray-900">
                                {{ $article->title() }}
                            </h3>
                            <div class="flex">
                                <a href="{{ route('articles.show', $article->slug()) }}" class="button mr-2">
                                    View
                                </a>
                                <a href="{{ route('articles.edit', $article->slug()) }}" class="button button-primary">
                                    Edit
                                </a>
                            </div>
                        </div>
                        <p class="mt-3 text-base leading-6 text-gray-500">
                            {{ $article->excerpt() }}
                        </p>
                    </a>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <a href="#">
                                    <img class="h-10 w-10 rounded-full" src="{{ $article->author()->gravatarUrl($avatarSize ?? 250) }}" alt="{{ $article->author()->name }}" />
                                </a>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm leading-5 font-medium text-gray-900">
                                    <a href="#">
                                        {{ $article->author()->name() }}
                                    </a>
                                </p>
                                <div class="flex text-sm leading-5 text-gray-500">
                                    @if ($article->isPublished())
                                        <time datetime="{{ $article->publishedAt()->format('Y-m-d') }}">
                                            Published {{ $article->publishedAt()->format('j M, Y') }}
                                        </time>
                                    @else
                                        <time datetime="{{ $article->updatedAt()->format('Y-m-d') }}">
                                            Drafted {{ $article->updatedAt()->format('j M, Y') }}
                                        </time>
                                    @endif
                                    <span class="mx-1">
                                        &middot;
                                    </span>
                                    <span>
                                        {{ $article->readTime() }} min read
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center text-gray-500">
                            <span class="text-2xl mr-2">👏</span>
                            {{ $article->likesCount() }}
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $articles->links() }}
        </div>
    </div>
@endsection