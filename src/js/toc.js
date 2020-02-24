window.addEventListener('DOMContentLoaded', () => {

    const toc = document.getElementById('penguin-toc');
    const headings = document.querySelectorAll('.entry-content h2, .entry-content h3');
    let div = document.createElement('div');

    const createToc = () => {
        headings.forEach((heading, i) => {
            heading.classList.add('toc');
            div.classList.add('toc-container');
            
            let ul = document.createElement('ul'),
                li = document.createElement('li'),
                a = document.createElement('a');

            if ( heading.classList.contains('toc') ) {
                if (heading.tagName === 'H2') {
                    let index2 = 'index2-';
                    heading.setAttribute('id', `${index2}${i+1}`);
                    
                    a.innerHTML = heading.textContent;
                    a.href = `#${index2}${i+1}`;
                    li.appendChild(a);

                    ul.appendChild(li);

                    div.appendChild(ul);
                }

                if (heading.tagName === 'H3') {
                    let index3 = 'index3-';
                    heading.setAttribute('id', `${index3}${i+1}`);

                    let lastUl = div.lastElementChild,
                        lastLi = lastUl.lastElementChild;

                    a.innerHTML = heading.textContent;
                    a.href = `#${index3}${i+1}`;
                    li.appendChild(a);

                    ul.appendChild(li);

                    lastLi.appendChild(ul);
                }
            }

            toc.appendChild(div);
        });

    }

    headings.length >  0 ? createToc() : console.log('undefined heading');

});


