@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
            <div id="search-wrapper">
                <form action="/" method="GET" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="query" class="form-control" placeholder="Enter your search query" value="{{ $query or '' }}" />
                        <button type="submit" name="search-button" class="form-control glyphicon glyphicon-search"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (!empty($query))
        <div class="row" id="filters-wrapper">
            <div class="col-xs-6 col-xs-offset-3">
                <strong>Price:</strong>

                @foreach ($aggregations['aggregations']['price_ranges']['buckets'] as $bucket)
                    <a href="?query={{ $query }}&page={{ $page }}&startprice={{ $bucket['from'] }}&endprice={{ $bucket['to'] }}&status={{ $status or '' }}&category={{ $category or '' }}" class="{{ $bucket['from'] == $startPrice && $bucket['to'] == $endPrice ? 'active' : '' }}">
                        {{ $bucket['from'] }} - {{ $bucket['to'] }} ({{ $bucket['doc_count'] }})
                    </a>
                @endforeach

                <br />

                <strong>Status:</strong>

                @foreach ($aggregations['aggregations']['statuses']['buckets'] as $bucket)
                    <a href="?query={{ $query }}&page={{ $page }}&status={{ urlencode($bucket['key']) }}&startprice={{ $startPrice or '' }}&endprice={{ $endPrice or '' }}&category={{ $category or '' }}" class="{{ $bucket['key'] == $status ? 'active' : '' }}">
                        {{ ucfirst($bucket['key']) }} ({{ $bucket['doc_count'] }})
                    </a>
                @endforeach

                <br />

                <strong>Category:</strong>

                @foreach ($aggregations['aggregations']['categories']['categories_count']['buckets'] as $bucket)
                    <a href="?query={{ $query }}&page={{ $page }}&category={{ urlencode($bucket['key']) }}&status={{ $status or '' }}&startprice={{ $startPrice or '' }}&endprice={{ $endPrice or '' }}" class="{{ $bucket['key'] == $category ? 'active' : '' }}">
                        {{ ucfirst($bucket['key']) }} ({{ $bucket['doc_count'] }})
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    @if (!empty($hits))
        <div class="row" id="results-text">
            <div class="col-xs-8 col-xs-offset-2">
                Displaying results {{ ($from + 1) }} to {{ $to }} of {{ $total }}.
            </div>
        </div>

        @foreach ($hits as $hit)
            <div class="row">
                <div class="col-xs-8 col-xs-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="/product/view/{{ $hit['_id'] }}">{{ $hit['_source']['name'] }}</a>
                        </div>
                        
                        <div class="panel-body">
                            <p>{{ $hit['_source']['description'] }}</p>

                            <strong>Price:</strong> {{ $hit['_source']['price'] }}
                            <br />
                            <strong>Status:</strong> {{ ucfirst($hit['_source']['status']) }}
                            <br />
                            <strong>Categories:</strong>

                            @foreach ($hit['_source']['categories'] as $c)
                                {{ $c['name'] }} &nbsp;
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="pagination-wrapper col-xs-8 col-xs-offset-2">
                <nav>
                    <ul class="pagination">
                        <li>
                            <a href="?query={{ urlencode($query) }}&page={{ ($page - 1) }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        @for ($i = 1; $i <= 10; $i++)
                            <li {!! $i == $page ? 'class="active"' : '' !!}><a href="?query={{ urlencode($query) }}&page={{ $i }}&status={{ $status or '' }}&startprice={{ $startPrice or '' }}&endprice={{ $endPrice or '' }}&category={{ $category or '' }}">{{ $i }}</a></li>
                        @endfor

                        <li>
                            <a href="?query={{ urlencode($query) }}&page={{ ($page + 1) }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    @elseif (isset($hits))
        <div class="row" id="no-results">
            <div class="col-xs-6 col-xs-offset-3">
                <p>No results!</p>
            </div>
        </div>
    @endif
@endsection