<template>
    <div id="signUpFrom">
        <n-card title="Sign up" size="medium">
            <n-form ref="formRef" :model="modelRef" :rules="rules">
                <n-row :gutter="[12, 24]">
                    <n-col :span="12">
                        <n-form-item path="firstName" label="First Name">
                            <n-input v-model:value="modelRef.firstName" @keydown.enter.prevent s/>
                        </n-form-item>
                        <n-form-item path="email" label="Email">
                            <n-input v-model:value="modelRef.email" @keydown.enter.prevent/>
                        </n-form-item>
                        <n-form-item path="password" label="Password">
                            <n-input
                                v-model:value="modelRef.password"
                                type="password"
                                @input="handlePasswordInput"
                                @keydown.enter.prevent
                            />
                        </n-form-item>
                    </n-col>
                    <n-col :span="12">
                        <n-form-item path="lastName" label="Last Name">
                            <n-input v-model:value="modelRef.lastName" @keydown.enter.prevent/>
                        </n-form-item>
                        <n-form-item path="integrator" label="Integrator">
                            <n-select
                                v-model:value="modelRef.integrator"
                                :options="integrationOptionsRef"
                                :loading="integrationLoadingRef"
                                @keydown.enter.prevent
                            />
                        </n-form-item>
                        <n-form-item
                            ref="rPasswordFormItemRef"
                            first
                            path="reenteredPassword"
                            label="Re-enter Password"
                        >
                            <n-input
                                v-model:value="modelRef.reenteredPassword"
                                :disabled="!modelRef.password"
                                type="password"
                                @keydown.enter.prevent
                            />
                        </n-form-item>
                        <n-row :gutter="[0, 24]">
                            <n-col :span="24">
                                <div style="display: flex; justify-content: flex-end">
                                    <n-button
                                        round
                                        type="primary"
                                        @click="handleValidateButtonClick"
                                        @keydown.enter.prevent
                                    >
                                        Continue
                                    </n-button>
                                </div>
                            </n-col>
                        </n-row>
                    </n-col>
                </n-row>
            </n-form>
            <n-row :gutter="[0, 24]">
                <n-col :span="12">
                    Request data
                    <n-code :code="JSON.stringify(requestData, null, 2)" language="JScript"/>
                </n-col>
                <n-col :span="12">
                    Response data
                    <n-code :code="JSON.stringify(responseData, null, 2)" language="json"/>
                </n-col>
            </n-row>
        </n-card>
    </div>
</template>

<script setup lang="ts">
import {onMounted, ref} from "vue";
import {
    FormInst,
    FormItemInst,
    FormRules,
    FormValidationError, SelectOption, useLoadingBar,
    useMessage,
} from "naive-ui";

import {validateEmail} from "../../utils/rules/email";
import {ModelType} from "./interfaces/Model";
import {signUp} from "../../utils/services/auth";
import {validationMaxLength, validationMinLength} from "../../utils/rules/input";
import {validatePasswordSame, validatePasswordStartWith} from "../../utils/rules/password";
import {prepareSignUp} from "../../utils/prepare/auth";
import {getIntegrations} from "../../utils/services/integration";
import {SignUpRequest} from "../../interfaces/auth/signup";

const formRef = ref<FormInst | null>(null)
const rPasswordFormItemRef = ref<FormItemInst | null>(null)
const message = useMessage()
const loadingBar = useLoadingBar()
const modelRef = ref<ModelType>({
    firstName: null,
    lastName: null,
    email: null,
    password: null,
    reenteredPassword: null,
    integrator: null
})

const integrationLoadingRef = ref(false)
const integrationOptionsRef = ref<SelectOption[]>([])

const requestData = ref<SignUpRequest | null>(null);
const responseData = ref<any>(null);

onMounted(() => {
    integrationLoadingRef.value = true;
    loadingBar.start()
    getIntegrations()
        .then(
            (res) => {
                loadingBar.finish()
                integrationLoadingRef.value = false;
                integrationOptionsRef.value = res.data.data.map((el) =>
                    ({value: el.id.toString(), label: el.name}))
            })
        .catch((e) => {
            loadingBar.finish()
            console.error(e.toString())
            integrationOptionsRef.value = []
            integrationLoadingRef.value = false;
        })
})

const rules: FormRules = {
    firstName: [
        {
            required: true,
            message: 'First name is required',
            trigger: ['input', 'blur']
        },
        {
            validator: validationMaxLength(50),
            message: 'The first name must be longer less than 50 characters',
            trigger: ['input', 'blur']
        }
    ],
    lastName: [
        {
            required: true,
            message: 'Last name is required',
            trigger: ['input', 'blur']
        },
        {
            validator: validationMaxLength(50),
            message: 'The last name must be longer less than 50 characters',
            trigger: ['input', 'blur']
        }
    ],
    email: [
        {
            required: true,
            message: 'Email is required',
            trigger: ['input', 'blur']
        },
        {
            validator: validateEmail,
            message: 'Email is invalid',
            trigger: ['input', 'blur']
        }
    ],
    password: [
        {
            required: true,
            message: 'Password is required'
        },
        {
            validator: validationMinLength(6),
            message: 'Password must be longer than 6 characters',
            trigger: ['input', 'blur']
        }
    ],
    reenteredPassword: [
        {
            required: true,
            message: 'Re-entered password is required',
            trigger: ['input', 'blur']
        },
        {
            validator: validatePasswordStartWith(modelRef),
            message: 'Password is not same as re-entered password!',
            trigger: 'input'
        },
        {
            validator: validatePasswordSame(modelRef),
            message: 'Password is not same as re-entered password!',
            trigger: ['blur', 'password-input']
        }
    ],
    integrator: [
        {
            required: true,
            message: 'Please select integrator',
            trigger: ['change', 'blur']
        }
    ]
}

const handlePasswordInput = () => {
    if (modelRef.value.reenteredPassword) {
        rPasswordFormItemRef.value?.validate({trigger: 'password-input'})
    }
}

const handleValidateButtonClick = (e: MouseEvent) => {
    e.preventDefault()
    formRef.value?.validate(
        (errors: Array<FormValidationError> | undefined) => {
            if (!errors) {
                const modelRequest = prepareSignUp(modelRef.value)
                requestData.value = modelRequest
                loadingBar.start()
                signUp(modelRequest)
                    .then((res) => {
                        loadingBar.finish()
                        responseData.value = res.data
                    })
                    .catch((e) => {
                        loadingBar.finish()
                        responseData.value = e.response ? e.response.data : e.toString()
                    })
            } else {
                message.error('Fix the mistakes')
                requestData.value = null
                responseData.value = null
            }
        }
    )
}
</script>

<style scoped>
#signUpFrom {
    margin-left: 20px;
    margin-right: 20px;
    margin-top: 40px;
}

</style>
