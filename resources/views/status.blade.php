@extends('layouts.navbar')

@section('name', 'Status Page')

@section('content')
<div class="status-container">
    <div
        class="status-circle {{ $status->open_or_not ? 'open' : 'close' }}"
        onclick="updateStatus()">
        {{ $status->open_or_not ? 'OPEN' : 'CLOSE' }}
    </div>
</div>
@endsection

<style>
/* تصميم الصفحة */
.status-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f4f4f9;
    font-family: Arial, sans-serif;
}

/* تصميم الدائرة */
.status-circle {
    width: 250px;
    height: 250px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%; /* دائرة مثالية */
    font-size: 24px;
    font-weight: bold;
    color: white;
    text-transform: uppercase;
    transition: all 0.3s ease-in-out;
    position: relative; /* لإدارة التأثير */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* توهج أساسي */
}

/* توهج الدائرة في حالة الفتح */
.status-circle.open {
    background-color: #28a745;
    box-shadow: 0 0 15px rgba(40, 167, 69, 0.7), 0 0 20px rgba(40, 167, 69, 0.5);
}

/* توهج الدائرة في حالة الإغلاق */
.status-circle.close {
    background-color: #dc3545;
    box-shadow: 0 0 15px rgba(220, 53, 69, 0.7), 0 0 20px rgba(220, 53, 69, 0.5);
}

/* إضافة تأثير نبض */
.status-circle.open::after,
.status-circle.close::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    height: 100%;
    border-radius: 50%; /* دائري تمامًا */
    animation: pulse 1.5s infinite;
}

/* تأثير نبض للأخضر */
.status-circle.open::after {
    box-shadow: 0 0 30px rgba(40, 167, 69, 0.5);
}

/* تأثير نبض للأحمر */
.status-circle.close::after {
    box-shadow: 0 0 30px rgba(220, 53, 69, 0.5);
}

/* حركة النبض */
@keyframes pulse {
    0% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.8;
    }
    50% {
        transform: translate(-50%, -50%) scale(1.2);
        opacity: 0.5;
    }
    100% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.8;
    }
}
</style>
<script>
    function updateStatus() {
        fetch('{{ route('status.update') }}', {
            method: 'GET', // أو POST إذا كنت تحتاج إلى حماية إضافية
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // حماية CSRF
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // تحديث واجهة المستخدم بناءً على الحالة الجديدة
                const circle = document.querySelector('.status-circle');
                if (data.open_or_not) {
                    circle.classList.remove('close');
                    circle.classList.add('open');
                    circle.textContent = 'OPEN';
                } else {
                    circle.classList.remove('open');
                    circle.classList.add('close');
                    circle.textContent = 'CLOSE';
                }
            } else {
                alert('Failed to update status.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
</script>
