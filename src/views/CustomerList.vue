<template>
  <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="mb-0">รายชื่อลูกค้า</h2>
      <router-link to="/add" class="btn btn-primary">+ เพิ่มลูกค้า</router-link>
    </div>

    <div v-if="error" class="alert alert-danger">{{ error }}</div>
    <div v-if="loading" class="text-center">กำลังโหลดข้อมูล...</div>

    <table v-else class="table table-bordered table-striped text-center align-middle">
      <thead class="table-dark">
        <tr>
          <th>ลำดับ</th>
          <th>รหัส</th>
          <th>ชื่อ</th>
          <th>นามสกุล</th>
          <th>เบอร์โทร</th>
          <th>ชื่อผู้ใช้</th>
          <th>จัดการ</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in customers" :key="item.customer_id">
          <td>{{ index + 1 }}</td>
          <td>{{ item.customer_id }}</td>
          <td>{{ item.firstName }}</td>
          <td>{{ item.lastName }}</td>
          <td>{{ item.phone }}</td>
          <td>{{ item.username }}</td>
          <td>
            <router-link :to="`/edit/${item.customer_id}`" class="btn btn-warning btn-sm me-1">แก้ไข</router-link>
            <button class="btn btn-danger btn-sm" @click="removeCustomer(item)">ลบ</button>
          </td>
        </tr>
        <tr v-if="customers.length === 0">
          <td colspan="7" class="text-muted">ยังไม่มีข้อมูล</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { API_BASE } from '../config'

export default {
  name: 'CustomerList',
  data() {
    return { customers: [], loading: true, error: '' }
  },
  mounted() {
    this.loadData()
  },
  methods: {
    // แสดงข้อมูล (Read)
    async loadData() {
      this.loading = true
      try {
        const res = await fetch(`${API_BASE}/show_customer.php`)
        const result = await res.json()
        if (!result.success) throw new Error(result.message)
        this.customers = result.data
      } catch (err) {
        this.error = 'เกิดข้อผิดพลาด: ' + err.message
      } finally {
        this.loading = false
      }
    },
    // ลบข้อมูล (Delete)
    async removeCustomer(item) {
      if (!confirm(`ต้องการลบ ${item.firstName} ${item.lastName} ใช่หรือไม่?`)) return
      try {
        const res = await fetch(`${API_BASE}/delete_customer.php`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ customer_id: item.customer_id })
        })
        const result = await res.json()
        if (!result.success) throw new Error(result.message)
        this.customers = this.customers.filter(c => c.customer_id !== item.customer_id)
      } catch (err) {
        this.error = 'เกิดข้อผิดพลาด: ' + err.message
      }
    }
  }
}
</script>
