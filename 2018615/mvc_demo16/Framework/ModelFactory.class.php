<?php
//����������:
//ͨ����������࣬���Դ��ݹ���һ��ģ���������
//�����ظ����һ��ʵ�������󣩣����ң���֤��Ϊ�������ġ�
class ModelFactory{
    Static  $all_model = array();//���ڴ洢����ģ�����Ψһʵ����������
    Static function M( $model_name ){//$model_name��һ��ģ���������

        if( !isset(self::$all_model[$model_name]) || !( self::$all_model[$model_name] instanceof  $model_name ))
        {
            self::$all_model[$model_name] = new $model_name();
        }
        return self::$all_model[$model_name];
    }
}
