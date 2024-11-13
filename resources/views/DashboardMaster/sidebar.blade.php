<div class="sidebar">
    <div class="user-profile">
        <div class="user-avatar"></div>
        <div class="user-info">
            <a href="#">{{ Auth::user()->name }}</a><br>
            <span>Welcome</span>
        </div>
    </div>
    <div class="menu">
        <h2>Dashboard Menu</h2>
        <ul>
            <li><a href="#">Lista de Users&nbsp; <span>&gt;</span></a></li>
            <li><a href="#">Lista de Eventos&nbsp; <span>&gt;</span></a></li>
            <li><a href="#">Histórico de Pagamentos&nbsp; <span>&gt;</span></a></li>
            <li><a href="#">Histórico de Eventos&nbsp; <span>&gt;</span></a></li>
        </ul>
    </div>
    <button class="logout-button">Logout</button>
</div>