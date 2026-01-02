<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
</head>
<body>
<form method="GET" action="{{ url()->current() }}">
    <input
        type="text"
        name="title"
        placeholder="Search by title"
        value="{{ request('title') }}"
    >

    <select name="status">
        <option value="">-- Status --</option>
        <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
        <option value="Scheduled" {{ request('status') == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
        <option value="Published" {{ request('status') == 'Published' ? 'selected' : '' }}>Published</option>
    </select>

    <select name="category_id">
        <option value="">-- Category --</option>
        @foreach($categories as $category)
            <option
                value="{{ $category->id }}"
                {{ request('category_id') == $category->id ? 'selected' : '' }}
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Filter</button>
    <a href="{{ url()->current() }}">Reset</a>
</form>

<h1>Posts</h1>

<table border="1">
    <tr>
        <th>Title</th>
        <th>Status</th>
        <th>Category</th>
    </tr>

    @foreach($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>{{ $post->status }}</td>
            <td>{{ $post->category->name ?? '-' }}</td>
        </tr>
    @endforeach

</table>

</body>
</html>
