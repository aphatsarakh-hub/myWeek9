@extends('layout')

@section('title')
    บทความทั้งหมด | Aphatsara Khaemadan
@endsection

@section('content')
    <div class="container py-4" style="margin-top: 60px; max-width: 950px;">

        <!-- หัวข้อหลักจัดตรงกลาง -->
        <h2 class="text-center fw-bold mb-4" style="font-size: 1.8rem; color: #1e293b;">
            บทความทั้งหมด
        </h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- ตารางแสดงบทความ -->
        <div class="table-responsive bg-white">
            <table class="table table-bordered align-middle text-center mb-0" style="border-color: #e2e8f0;">
                <thead>
                    <tr>
                        <th style="width: 60%; font-weight: 700; color: #000000; padding: 12px;" class="text-center">Title
                        </th>
                        <th style="width: 20%; font-weight: 700; color: #000000; padding: 12px;" class="text-center">Status
                        </th>
                        <th style="width: 20%; font-weight: 700; color: #000000; padding: 12px;" class="text-center">Control
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $items = isset($blogs) ? $blogs : (isset($blog) ? $blog : []);
                    @endphp

                    @forelse ($items as $item)
                        <tr>
                            <!-- คอลัมน์ Title -->
                            <td class="text-center py-3 px-4" style="color: #334155; font-size: 0.95rem; line-height: 1.5;">
                                {{ $item->title }}
                            </td>

                            <!-- คอลัมน์ Status -->
                            <td class="text-center py-3">
                                @if ($item->status == 'published' || $item->status == '1' || $item->status == true)
                                    <a href="/change-status/{{ $item->id }}" class="btn btn-success">เผยแพร่</a>
                                @else
                                    <a href="/change-status/{{ $item->id }}" class="btn btn-danger">ไม่เผยแพร่</a>
                                @endif
                            </td>

                            <!-- คอลัมน์ Control -->
                            <td class="text-center py-3">
                                <a href="/delete/{{ $item->id }}" class="btn btn-danger"
                                    onclick="return confirm('คุณต้องการลบบทความนี้หรือไม่?')">ลบ</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">
                                ไม่พบข้อมูลบทความ
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination ลิงก์แบ่งหน้า (ถ้ามี) -->
        @if (method_exists($items, 'links'))
            <div class="d-flex justify-content-center mt-4">
                {{ $items->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
@endsection
