   
   const link = 'http://localhost/ebook';

   const record = type => {

        const xhr = new XMLHttpRequest();

        xhr.open('GET', `${link}/API/record.php?${type}`, true);

        xhr.onload = () => {
            
            if(xhr.status === 200){

                console.log(xhr.responseText);
            }
        }

        xhr.send();

   }
   
   //function to record downloads
    const download = () => {

            document.querySelector('#info').innerHTML = `<p>Downloading file...</p>`;

            setTimeout(() => {

                document.querySelector('#info').innerHTML = '';

            }, 3000);

            record('download');



    }


    //function to record views
    const view = e => {

        e.preventDefault();

        const link = document.querySelector('#link').value;

        console.log(`opening - ${link}`);

        document.querySelector('#info').innerHTML = `<p>Opening file...</p>`;

        setTimeout(() => {

            window.location = link;

        }, 2000);

        record('view');

    }


        
    document.querySelector('#view').addEventListener('click', view);
    document.querySelector('#download').addEventListener('click', download);