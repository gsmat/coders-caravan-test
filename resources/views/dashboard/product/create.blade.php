
@extends('dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card p-5">
                <div class="card-body">

                    <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content:</label>
                            <textarea class="form-control" name="content" id="content" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image:</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price:</label>
                            <input type="number" step="0.01" class="form-control" name="price" id="price" required>
                        </div>

                        <div class="mb-3">
                            <label for="stock_count" class="form-label">Stock Count:</label>
                            <input type="number" class="form-control" name="stock_count" id="stock_count" required>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="has_stock" id="has_stock" checked>
                            <label class="form-check-label" for="has_stock">Has Stock</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection