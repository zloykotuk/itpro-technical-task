import {FormItemRule} from "naive-ui";
import {Ref} from "vue";

export const validatePasswordStartWith = (modelRef: Ref<{password: string | null}>) =>
    (rule: FormItemRule, value: string): boolean =>
        !!modelRef.value.password && modelRef.value.password.startsWith(value)
        && modelRef.value.password.length >= value.length

export const validatePasswordSame = (modelRef: Ref<{password: string | null}>) =>
    (rule: FormItemRule, value: string): boolean =>
        value === modelRef.value.password
