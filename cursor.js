<script>
    const cursor = document.createElement('div');
    cursor.classlist.add('customCursor');
    document.body.appendChild(cursor);

    document.addEventListener('mousemove', (e) => {
        document.documentElement.style.setProperty('--mouse-x', e.pageX);
        document.documentElement.style.setProperty('--mouse-y', e.pageX);
    });
</script>