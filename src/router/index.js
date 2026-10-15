import { createRouter, createWebHistory } from 'vue-router'
import CustomerList from '../views/CustomerList.vue'
import CustomerAdd from '../views/CustomerAdd.vue'
import CustomerEdit from '../views/CustomerEdit.vue'

const routes = [
  { path: '/', name: 'list', component: CustomerList },
  { path: '/add', name: 'add', component: CustomerAdd },
  { path: '/edit/:id', name: 'edit', component: CustomerEdit }
]

export default createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})
