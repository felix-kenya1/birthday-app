@extends('layouts.public')
@section('title','Manage '.$label)
@section('content')<section class="section-shell"><div class="container">
<p><a href="{{ route('admin.dashboard') }}">← Dashboard</a></p><h1>{{ $label }}</h1>
@if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
<a class="btn btn-dark mb-3" href="{{ route('admin.content.create',$type) }}">+ Add {{ \Illuminate\Support\Str::singular($label) }}</a>
<div class="table-responsive"><table class="table table-striped"><thead><tr><th>Title / Name</th><th>Status</th><th>Order</th><th>Actions</th></tr></thead><tbody>
@forelse($items as $item)<tr><td>{{ $item->title ?? $item->track_title ?? 'Birthday wish' }}</td><td>{{ isset($item->is_published) ? ($item->is_published?'Published':'Draft') : (isset($item->enabled) && $item->enabled?'Enabled':'Disabled') }}</td><td>{{ $item->sort_order ?? '—' }}</td><td class="d-flex gap-2"><a class="btn btn-sm btn-outline-dark" href="{{ route('admin.content.edit',[$type,$item->id]) }}">Edit</a><form method="POST" action="{{ route('admin.content.destroy',[$type,$item->id]) }}" onsubmit="return confirm('Delete this item?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>
@empty<tr><td colspan="4">No content yet. Add your first item.</td></tr>@endforelse
</tbody></table></div>{{ $items->links() }}
</div></section>@endsection
