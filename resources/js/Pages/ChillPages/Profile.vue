<script setup>
import { ref } from 'vue';

const isEditing = ref(null);
const profile = ref({
  name: 'John Doe',
  email: 'user@example.com',
  bio: 'Lover of peaceful spots and cozy cafes.',
});

const originalProfile = ref({ ...profile.value });

const toggleEdit = (field) => {
  if (isEditing.value === field) {
    // Save logic
    originalProfile.value[field] = profile.value[field];
    isEditing.value = null;
    console.log(`${field} updated:`, profile.value[field]);
  } else {
    isEditing.value = field;
  }
};

const cancelEdit = (field) => {
  profile.value[field] = originalProfile.value[field];
  isEditing.value = null;
};

const showPasswordForm = ref(false);
const togglePasswordSection = () => {
  showPasswordForm.value = !showPasswordForm.value;
};
</script>

<template>
  <section id="profile-section" class="profile-section section">
    <h2>Account Settings</h2>
    <div class="profile-pic"></div>

    <div id="public-section" class="public-section">
      <div class="form-group">
        <label>Profile Picture</label>
        <button class="edit-btn">Change</button>
      </div>

      <div class="form-group">
        <label>Name</label>
        <span v-if="isEditing !== 'name'">{{ profile.name }}</span>
        <input v-if="isEditing === 'name'" v-model="profile.name" type="text">
        <button v-if="isEditing === 'name'" class="cancel-btn" @click="cancelEdit('name')">Cancel</button>
        <button class="edit-btn" @click="toggleEdit('name')">{{ isEditing === 'name' ? 'Save' : 'Edit' }}</button>
      </div>

      <div class="form-group">
        <label>Email</label>
        <span v-if="isEditing !== 'email'">{{ profile.email }}</span>
        <input v-if="isEditing === 'email'" v-model="profile.email" type="email">
        <button v-if="isEditing === 'email'" class="cancel-btn" @click="cancelEdit('email')">Cancel</button>
        <button class="edit-btn" @click="toggleEdit('email')">{{ isEditing === 'email' ? 'Save' : 'Edit' }}</button>
      </div>

      <div class="form-group">
        <label>Bio</label>
        <span v-if="isEditing !== 'bio'">{{ profile.bio }}</span>
        <textarea v-if="isEditing === 'bio'" v-model="profile.bio"></textarea>
        <button v-if="isEditing === 'bio'" class="cancel-btn" @click="cancelEdit('bio')">Cancel</button>
        <button class="edit-btn" @click="toggleEdit('bio')">{{ isEditing === 'bio' ? 'Save' : 'Edit' }}</button>
      </div>
    </div>

    <button class="edit-password-btn" @click="togglePasswordSection">Edit Password</button>

    <div v-if="showPasswordForm" class="password-section">
      <div class="form-group">
        <label for="current-password">Current Password</label>
        <input type="password" id="current-password" placeholder="Current Password">
      </div>
      <div class="form-group">
        <label for="new-password">New Password</label>
        <input type="password" id="new-password" placeholder="New Password">
      </div>
      <div class="form-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" placeholder="Confirm Password">
      </div>
      <button class="save-btn">Save</button>
    </div>
  </section>
</template>

<style scoped>
.profile-section {
  text-align: center;
}

.profile-pic {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background: #ccc;
  display: inline-block;
  margin-bottom: 30px;
}

.form-group {
  margin-bottom: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
}

.form-group label {
  display: block;
  font-weight: bold;
}

.form-group span {
  flex-grow: 1;
  text-align: left;
}

.form-group input,
.form-group textarea {
  width: 70%;
  padding: 8px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.edit-btn,
.cancel-btn {
  padding: 8px 12px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.edit-btn {
  background-color: #88B04B;
  color: white;
}

.cancel-btn {
  background-color: #6C7A89;
  color: white;
}

.edit-password-btn {
  background: #88B04B;
  color: white;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  width: 300px;
  margin-top: 30px;
}
</style>
