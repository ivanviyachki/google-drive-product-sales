<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>

<style>
body {
    font-family:Montserrat;
}
body::-webkit-scrollbar {
    -webkit-appearance: none;
    width: 10px;
}
body::-webkit-scrollbar-thumb {
    border-radius: 8px;
    border: 1px solid white;
    background-color: rgb(165 103 152);
}
body::-webkit-scrollbar-track {
  background: #fff;
}
.flip-entry:hover:before {
    content: 'Кликни, за да гледаш. Ако имате проблем, с визуализация на видеото след отваряне, моля прегледайте стъпките от бутон "Имате проблем?".';
    position: absolute;
    color: #842029;
    background-color: #f8d7da;
    border-color: #f5c2c7;
    padding: 1rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 0.25rem;
    font-family: Montserrat;
    width: 200px;
    left: 100px;
    font-size: 12px;
    top: 30px;
}

.flip-entry {
    position: relative;
}
.flip-entry-last-modified,.flip-list-header,.flip-list-last-modified-header{display:none}.flip-entry-info a{display:flex;margin-bottom:10px;font-family:Montserrat;text-decoration:none;color:#a56798}.flip-entry-list-icon{margin-right:10px}
.flip-entry-thumb img {
    width: 140px;
    height: 140px;
    object-fit: cover;
}

.flip-entry-title {
    word-break: break-all;
}
/** iPad Pro - 1024px **/
@media screen and (max-width: 1024px) {
    video#v1 {
        height: auto !important;
    }
}
</style>