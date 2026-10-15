<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <router-link class="navbar-brand" to="/">Exam CRUD</router-link>
      <div class="navbar-nav ms-auto flex-row gap-3">
        <router-link class="nav-link" to="/">รายชื่อลูกค้า</router-link>
        <router-link class="nav-link" to="/add">เพิ่มลูกค้า</router-link>
      </div>
    </div>
  </nav>
</template>

<script>
export default { name: 'Navbar' }
</script>
