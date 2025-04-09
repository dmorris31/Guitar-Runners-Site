// This will handle the basic toggle between front and back images when hovered over
document.querySelectorAll('.item').forEach(item => {
    item.addEventListener('mouseenter', () => {
        const front = item.querySelector('.front');
        const back = item.querySelector('.back');
        front.style.opacity = '0';
        back.style.opacity = '1';
    });

    item.addEventListener('mouseleave', () => {
        const front = item.querySelector('.front');
        const back = item.querySelector('.back');
        front.style.opacity = '1';
        back.style.opacity = '0';
    });
});
