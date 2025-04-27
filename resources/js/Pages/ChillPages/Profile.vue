<script setup>
import { watch, computed, ref } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'
import Toast from '@/Components/Toast.vue'

const user = computed(() => usePage().props.auth.user);
const showModal = ref(false)
const toast = ref(null)

const form = useForm({
  bio: user.bio ?? '',
  clear_bio: false,
  profile_image: null,
  new_password: '',
  new_password_confirmation: ''
})

function handleFileChange(e) {
  form.profile_image = e.target.files[0]
}

function submit() {
  form.post(route('mypage.update'), {
    forceFormData: true,
    onSuccess: () => {
      showModal.value = false
      toast.value.triggerToast('Profile updated successfully');
    },
    onError: (errors) => {
      toast.value.triggerToast(errors, 'error');
    },
  })
}
function closeModal() {
  showModal.value = false
  form.reset()
}
</script>

<template>
  <Toast ref="toast" />

  <div>
    <h3>Profile</h3>
      <div v-if="user.profile_image" class="text-center mt-5">
        <img :src="`/storage/${user.profile_image}`" alt="Profile Image" class="profile-pic" />
      </div>
      <div v-else class="profile-pic text-center mt-3"></div>

    <div class="d-flex justify-content-center">
      <div class="card p-4 w-100" style="max-width: 600px;">
        <div class="row mb-2">
          <div class="col-4 fw-bold text-start">Name:</div>
          <div class="col-8 text-start">{{ user.name }}</div>
        </div>
        <div class="row mb-2">
          <div class="col-4 fw-bold text-start">Email:</div>
          <div class="col-8 text-start">{{ user.email }}</div>
        </div>
        <div class="row mb-2">
          <div class="col-4 fw-bold text-start">Bio:</div>
          <div class="col-8 text-start">{{ user.bio }}</div>
        </div>

        <div v-if="user.profile_image_url" class="mb-3">
          <img :src="user.profile_image_url" class="img-thumbnail" alt="Profile Image" style="max-width: 200px;" />
        </div>

        <button class="btn mt-5" @click="showModal = true">Edit Profile</button>
      </div>
    </div>
  </div>

  <!-- 編集モーダル -->
  <div v-if="showModal" class="modal-backdrop-custom">
    <div class="modal d-block" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Profile</h5>
            <button type="button" class="btn-close" @click="closeModal"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="submit" enctype="multipart/form-data">
              <div class="mb-3">
                <label class="form-label">Bio</label>
                <textarea v-model="form.bio" class="form-control" rows="3"></textarea>
                <div class="form-check mt-1">
                  <label class="form-check-label" for="clearBio">Clear bio (delete)</label>
                  <input type="checkbox" class="form-check-input" id="clearBio" v-model="form.clear_bio">
                </div>
                <div class="text-danger" v-if="form.errors.bio">{{ form.errors.bio }}</div>
              </div>

              <div class="mb-4">
                <h4 class="form-label">Profile Image</h4>
                <input type="file" @change="handleFileChange" class="form-control" />
                <div class="text-danger" v-if="form.errors.profile_image">{{ form.errors.profile_image }}</div>
              </div>

              <div class="password-edit mt-4">
                <h4>Password</h4>
                <div class="mt-4 mb-4">
                  <label class="form-label">New Password</label>
                  <input type="password" v-model="form.new_password" class="form-control" />
                  <div class="text-danger" v-if="form.errors.new_password">{{ form.errors.new_password }}</div>
                </div>

                <div class="mb-3">
                  <label class="form-label">Confirm Password</label>
                  <input type="password" v-model="form.new_password_confirmation" class="form-control" />
                </div>
              </div>

              <div class="modal-footer px-0">
                <button type="button" class="btn cancel-btn" @click="closeModal">Cancel</button>
                <button type="submit" class="btn">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.profile-section {
  text-align: center;
}

.public-section {
  margin-bottom: 50px;
}

.password-section {
  margin-top: 15px;
  margin-bottom: 30px;
}

.profile-pic {
  margin: 0 auto;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background: #ccc;
  display: inline-block;
  margin-bottom: 30px;
}

.edit-btn {
  background-color: #88B04B;
  color: white;
  padding: 8px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

/* モーダルの背景 */
.modal-backdrop-custom {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 1050;
}
</style>
