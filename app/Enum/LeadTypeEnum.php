<?php

namespace App\Enum;

enum LeadTypeEnum: string
{
case LEAD_ADDED = 'lead_added';
case LEAD_DELETED = 'lead_deleted';
case LEAD_RESTORED = 'lead_restored';
case LEAD_STATUS_CHANGED = 'lead_status_changed';
case LEAD_LINKED = 'lead_linked';
case LEAD_UNLINKED = 'lead_unlinked';
case CONTACT_ADDED = 'contact_added';
case CONTACT_DELETED = 'contact_deleted';
case CONTACT_RESTORED = 'contact_restored';
case CONTACT_LINKED = 'contact_linked';
case CONTACT_UNLINKED = 'contact_unlinked';
case COMPANY_ADDED = 'company_added';
case COMPANY_DELETED = 'company_deleted';
case COMPANY_RESTORED = 'company_restored';
case COMPANY_LINKED = 'company_linked';
case COMPANY_UNLINKED = 'company_unlinked';
case CUSTOMER_ADDED = 'customer_added';
case CUSTOMER_DELETED = 'customer_deleted';
case CUSTOMER_STATUS_CHANGED = 'customer_status_changed';
case CUSTOMER_LINKED = 'customer_linked';
case CUSTOMER_UNLINKED = 'customer_unlinked';
case TASK_ADDED = 'task_added';
case TASK_DELETED = 'task_deleted';
case TASK_COMPLETED = 'task_completed';
case TASK_TYPE_CHANGED = 'task_type_changed';
case TASK_TEXT_CHANGED = 'task_text_changed';
case TASK_DEADLINE_CHANGED = 'task_deadline_changed';
case TASK_RESULT_ADDED = 'task_result_added';
case INCOMING_CALL = 'incoming_call';
case OUTGOING_CALL = 'outgoing_call';
case INCOMING_CHAT_MESSAGE = 'incoming_chat_message';
case OUTGOING_CHAT_MESSAGE = 'outgoing_chat_message';
case ENTITY_DIRECT_MESSAGE = 'entity_direct_message';
case INCOMING_SMS = 'incoming_sms';
case OUTGOING_SMS = 'outgoing_sms';
case ENTITY_TAG_ADDED = 'entity_tag_added';
case ENTITY_TAG_DELETED = 'entity_tag_deleted';
case ENTITY_LINKED = 'entity_linked';
case ENTITY_UNLINKED = 'entity_unlinked';
case SALE_FIELD_CHANGED = 'sale_field_changed';
case NAME_FIELD_CHANGED = 'name_field_changed';
case LTV_FIELD_CHANGED = 'ltv_field_changed';
case CUSTOM_FIELD_VALUE_CHANGED = 'custom_field_value_changed';
case ENTITY_RESPONSIBLE_CHANGED = 'entity_responsible_changed';
case ROBOT_REPLIED = 'robot_replied';
case INTENT_IDENTIFIED = 'intent_identified';
case NPS_RATE_ADDED = 'nps_rate_added';
case LINK_FOLLOWED = 'link_followed';
case TRANSACTION_ADDED = 'transaction_added';
case COMMON_NOTE_ADDED = 'common_note_added';
case COMMON_NOTE_DELETED = 'common_note_deleted';
case ATTACHMENT_NOTE_ADDED = 'attachment_note_added';
case TARGETING_IN_NOTE_ADDED = 'targeting_in_note_added';
case TARGETING_OUT_NOTE_ADDED = 'targeting_out_note_added';
case GEO_NOTE_ADDED = 'geo_note_added';
case SERVICE_NOTE_ADDED = 'service_note_added';
case SITE_VISIT_NOTE_ADDED = 'site_visit_note_added';
case MESSAGE_TO_CASHIER_NOTE_ADDED = 'message_to_cashier_note_added';
case KEY_ACTION_COMPLETED = 'key_action_completed';
case ENTITY_MERGED = 'entity_merged';


    public function russian(): string
    {
        return match ($this) {
            self::LEAD_ADDED => 'Новая сделка',
            self::LEAD_DELETED => 'Сделка удалена',
            self::LEAD_RESTORED => 'Сделка восстановлена',
            self::LEAD_STATUS_CHANGED => 'Изменение этапа продажи',
            self::LEAD_LINKED => 'Прикрепление сделки',
            self::LEAD_UNLINKED => 'Открепление сделки',
            self::CONTACT_ADDED => 'Новый контакт',
            self::CONTACT_DELETED => 'Контакт удален',
            self::CONTACT_RESTORED => 'Контакт восстановлен',
            self::CONTACT_LINKED => 'Прикрепление контакта',
            self::CONTACT_UNLINKED => 'Открепление контакта',
            self::COMPANY_ADDED => 'Новая компания',
            self::COMPANY_DELETED => 'Компания удалена',
            self::COMPANY_RESTORED => 'Компания восстановлена',
            self::COMPANY_LINKED => 'Прикрепление компании',
            self::COMPANY_UNLINKED => 'Открепление компании',
            self::CUSTOMER_ADDED => 'Новый покупатель',
            self::CUSTOMER_DELETED => 'Покупатель удален',
            self::CUSTOMER_STATUS_CHANGED => 'Изменение этапа покупателя',
            self::CUSTOMER_LINKED => 'Прикрепление покупателя',
            self::CUSTOMER_UNLINKED => 'Открепление покупателя',
            self::TASK_ADDED => 'Новая задача',
            self::TASK_DELETED => 'Задача удалена',
            self::TASK_COMPLETED => 'Завершение задачи',
            self::TASK_TYPE_CHANGED => 'Изменение типа задачи',
            self::TASK_TEXT_CHANGED => 'Изменение текста задачи',
            self::TASK_DEADLINE_CHANGED => 'Изменение даты исполнения задачи',
            self::TASK_RESULT_ADDED => 'Результат по задаче',
            self::INCOMING_CALL => 'Входящий звонок',
            self::OUTGOING_CALL => 'Исходящий звонок',
            self::INCOMING_CHAT_MESSAGE => 'Входящее сообщение',
            self::OUTGOING_CHAT_MESSAGE => 'Исходящее сообщение',
            self::ENTITY_DIRECT_MESSAGE => 'Сообщение внутреннего чата',
            self::INCOMING_SMS => 'Входящее SMS',
            self::OUTGOING_SMS => 'Исходящее SMS',
            self::ENTITY_TAG_ADDED => 'Теги добавлены',
            self::ENTITY_TAG_DELETED => 'Теги убраны',
            self::ENTITY_LINKED => 'Прикрепление',
            self::ENTITY_UNLINKED => 'Открепление',
            self::SALE_FIELD_CHANGED => 'Изменение поля “Бюджет”',
            self::NAME_FIELD_CHANGED => 'Изменение поля “Название”',
            self::LTV_FIELD_CHANGED => 'Сумма покупок',
            self::CUSTOM_FIELD_VALUE_CHANGED => 'Изменение поля',
            self::ENTITY_RESPONSIBLE_CHANGED => 'Ответственный изменен',
            self::ROBOT_REPLIED => 'Ответ робота',
            self::INTENT_IDENTIFIED => 'Тема вопроса определена',
            self::NPS_RATE_ADDED => 'Новая оценка NPS',
            self::LINK_FOLLOWED => 'Переход по ссылке',
            self::TRANSACTION_ADDED => 'Добавлена покупка',
            self::COMMON_NOTE_ADDED => 'Новое примечание',
            self::COMMON_NOTE_DELETED => 'Примечание удалено',
            self::ATTACHMENT_NOTE_ADDED => 'Добавлен новый файл',
            self::TARGETING_IN_NOTE_ADDED => 'Добавление в ретаргетинг',
            self::TARGETING_OUT_NOTE_ADDED => 'Удаление из ретаргетинга',
            self::GEO_NOTE_ADDED => 'Новое примечание с гео-меткой',
            self::SERVICE_NOTE_ADDED => 'Новое системное примечание',
            self::SITE_VISIT_NOTE_ADDED => 'Заход на сайт',
            self::MESSAGE_TO_CASHIER_NOTE_ADDED => 'LifePay: Сообщение кассиру',
            self::KEY_ACTION_COMPLETED => 'Ключевое действие',
            self::ENTITY_MERGED => 'Выполнено объединение'
        };
    }
}
