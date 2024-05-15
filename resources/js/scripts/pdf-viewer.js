document.addEventListener('DOMContentLoaded', function() {
    const iframe = document.getElementById('pdf-iframe');
    const canvas = document.getElementById('signature-canvas');
    const ctx = canvas.getContext('2d');
    let rect = {}, drag = false;

    function onMouseDown(e) {
        rect.startX = e.offsetX;
        rect.startY = e.offsetY;
        drag = true;
    }

    function onMouseMove(e) {
        if (drag) {
            rect.w = e.offsetX - rect.startX;
            rect.h = e.offsetY - rect.startY;
            draw();
        }
    }

    function onMouseUp() {
        drag = false;
        document.getElementById('x').value = rect.startX;
        document.getElementById('y').value = rect.startY;
        document.getElementById('width').value = rect.w;
        document.getElementById('height').value = rect.h;
    }

    function draw() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.strokeStyle = 'red';
        ctx.strokeRect(rect.startX, rect.startY, rect.w, rect.h);
    }

    canvas.addEventListener('mousedown', onMouseDown);
    canvas.addEventListener('mousemove', onMouseMove);
    canvas.addEventListener('mouseup', onMouseUp);

    function setCanvasSize() {
        const rect = iframe.getBoundingClientRect();
        canvas.width = rect.width;
        canvas.height = rect.height;
        canvas.style.pointerEvents = 'auto'; // Permitir interações com o canvas
    }

    window.addEventListener('resize', setCanvasSize);
    setCanvasSize();
});
