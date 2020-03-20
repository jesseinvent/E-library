
const link = 'http://localhost/ebook';

//get books from API
const getBooks = (searchVal, type) => {

 
    const xhr = new XMLHttpRequest();

    xhr.open('GET', `${link}/API/searchApi.php?search&searchVal=${searchVal}&searchType=${type}&returnType=table`, true);

    xhr.onload = () => {

         if(xhr.status === 200){

            document.querySelector('#books-table').innerHTML = xhr.responseText;
            // console.log(xhr.responseText);
         }

    }

    xhr.send();

}

//get books by category
const getCategory = target => {

    if(target.target.value !== ''){

       const category = target.target.value;

       document.querySelector('#books-found').innerHTML = `Books on ${category}`;

       const type = 'category';
       document.querySelector('#books-table').innerHTML = "";
       getBooks(category, type);
    
    }
}

//get books by filter 
const getBooksFilter = () => {

  const searchVal = document.querySelector('#filter').value; 

  if(searchVal !== ''){

         const type = 'title';

         getBooks(searchVal, type);
  }
  
}


document.querySelector('#category').addEventListener('click', getCategory);
document.querySelector('#filter').addEventListener('keyup', getBooksFilter);

